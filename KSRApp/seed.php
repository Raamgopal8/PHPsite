#!/usr/bin/env php
<?php
// Load environment variables
require __DIR__ . '/vendor/autoload.php';

// Load MongoDB configuration
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$client = new MongoDB\Client(
    $_ENV['MONGODB_URI'],
    [
        'tlsAllowInvalidCertificates' => true,
        'tlsAllowInvalidHostnames' => true,
        'serverSelectionTimeoutMS' => 5000,
        'connectTimeoutMS' => 5000,
    ],
    [
        'typeMap' => [
            'array' => 'array',
            'document' => 'array',
            'root' => 'array',
        ],
    ]
);

$db = $client->selectDatabase($_ENV['DB_NAME']);

if (!$db) {
    die("MongoDB connection failed\n");
}

echo "Seeding...\n";

// users
try {
    $db->users->insertOne([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => password_hash('admin123', PASSWORD_BCRYPT),
        'role' => 'admin',
        'streak' => 0,
        'created_at' => date('c')
    ]);
    echo "Admin user created successfully\n";
} catch (Exception $e) {
    echo "Error creating admin user: " . $e->getMessage() . "\n";
}

try {
    $db->users->insertOne([
        'name' => 'Student One',
        'email' => 'student@gmail.com',
        'password' => password_hash('student123', PASSWORD_BCRYPT),
        'role' => 'student',
        'streak' => 0,
        'created_at' => date('c')
    ]);
    echo "Student user created successfully\n";

    // exam
    $examRes = $db->exams->insertOne([
        '_id' => 'exam_ssc_001',
        'title' => 'SSC General Mock',
        'category' => 'SSC',
        'duration' => 60,
        'questions' => ['q1', 'q2'],
        'status' => 'active',
        'created_at' => date('c')
    ]);
    echo "Exam created successfully\n";

    // questions
    $questions = $db->questions->insertMany([
        ['_id' => 'q1', 'exam_id' => 'exam_ssc_001', 'text' => '2+2 = ?', 'options' => ['1', '2', '4', '5'], 'answer' => 2, 'explanation' => '2+2 is 4'],
        ['_id' => 'q2', 'exam_id' => 'exam_ssc_001', 'text' => 'Capital of India?', 'options' => ['Mumbai', 'New Delhi', 'Kolkata', 'Chennai'], 'answer' => 1, 'explanation' => 'New Delhi']
    ]);
    echo "Questions added successfully\n";

    $db->achievers->insertOne([
        'name' => 'Top Student',
        'exam' => 'SSC General',
        'rank' => 1,
        'photo' => null
    ]);
    echo "Achiever added successfully\n";

    echo "Seeding completed successfully!\n";
} catch (Exception $e) {
    echo "Error during seeding: " . $e->getMessage() . "\n";
    exit(1);
}
try {
    $db->results->drop(); // Clear existing results
    
    // Sample students
    $students = [
        ['id' => '6427abc123', 'name' => 'Ramesh Kumar'],
        ['id' => '6427abc124', 'name' => 'Priya Sharma'],
        ['id' => '6427abc125', 'name' => 'Amit Patel'],
        ['id' => '6427abc126', 'name' => 'Sneha Gupta'],
        ['id' => '6427abc127', 'name' => 'Rajesh Singh']
    ];

    // Sample exams
    $exams = [
        ['id' => '64bd3fa12', 'title' => 'Aptitude Test 1', 'total_questions' => 10],
        ['id' => '64bd3fa13', 'title' => 'General Knowledge', 'total_questions' => 15],
        ['id' => '64bd3fa14', 'title' => 'Mathematics', 'total_questions' => 20]
    ];

    $results = [];
    $statuses = ['completed', 'in_progress', 'pending'];
    $startDate = strtotime('-30 days'); // Last 30 days
    $endDate = time();

    // Generate 50 sample results
    for ($i = 0; $i < 50; $i++) {
        $student = $students[array_rand($students)];
        $exam = $exams[array_rand($exams)];
        $score = rand(1, $exam['total_questions']);
        $percentage = round(($score / $exam['total_questions']) * 100, 2);
        $randomDays = rand(0, 30);
        $randomHours = rand(0, 23);
        $randomMinutes = rand(0, 59);
        $createdAt = date('c', strtotime("-$randomDays days -$randomHours hours -$randomMinutes minutes", $endDate));

        $results[] = [
            'student_id' => $student['id'],
            'student_name' => $student['name'],
            'exam_id' => $exam['id'],
            'exam_title' => $exam['title'],
            'score' => $score,
            'total_questions' => $exam['total_questions'],
            'percentage' => $percentage,
            'status' => $statuses[array_rand($statuses)],
            'created_at' => new MongoDB\BSON\UTCDateTime(strtotime($createdAt) * 1000),
            'updated_at' => new MongoDB\BSON\UTCDateTime(time() * 1000)
        ];
    }

    // Insert all results
    if (count($results) > 0) {
        $db->results->insertMany($results);
        echo "Successfully seeded " . count($results) . " results\n";
    } else {
        echo "No results to seed\n";
    }

} catch (Exception $e) {
    echo "Error seeding results: " . $e->getMessage() . "\n";
}
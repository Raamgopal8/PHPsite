<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Exam Scores Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
        .header-container { display: flex; items-center: center; justify-content: center; gap: 30px; border-bottom: 2px solid #1f2937; pb: 20px; mb: 20px; }
        .logo { height: 80px; width: 80px; object-fit: contain; }
        .header-text { text-align: left; }
        .college-name { font-size: 24px; font-weight: bold; color: #1f2937; margin: 0; text-transform: uppercase; }
        .college-loc { font-size: 18px; color: #4b5563; margin: 0; }
        h1 { text-align: center; color: #1f2937; margin: 20px 0 5px 0; font-size: 28px; }
        .timestamp { text-align: center; color: #6b7280; font-size: 0.9em; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #e5e7eb; padding: 10px 12px; text-align: left; }
        th { background-color: #f3f4f6; color: #374151; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .status-pass { color: #059669; font-weight: bold; }
        .status-fail { color: #dc2626; font-weight: bold; }
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
            table { font-size: 12pt; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #3b82f6; color: white; border: none; border-radius: 4px; cursor: pointer;">Print Report</button>
        <button onclick="window.close()" style="padding: 8px 16px; background: #6b7280; color: white; border: none; border-radius: 4px; cursor: pointer; margin-left: 8px;">Close</button>
    </div>

    <div class="header-container">
        <img src="/assets/KSR College of Engineering.jpg" alt="Collefe Logo" class="logo">
        <div class="header-text">
            <div class="college-name">KSR COLLEGE OF ENGINEERING</div>
            <div class="college-loc">Tiruchengode</div>
        </div>
    </div>

    <h1>Student Exam Scores Report</h1>
    <div class="timestamp">Generated on: <?= date('F j, Y') ?></div>

    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Exam Title</th>
                <th>Score</th>
                <th>Percentage</th>
                <th>Status</th>
                <th>Submission Time</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($results)): ?>
                <tr>
                    <td colspan="6" style="text-align: center; color: #6b7280;">No exam scores found</td>
                </tr>
            <?php else: ?>
                <?php foreach($results as $result): 
                    $isPass = ($result['percentage'] ?? 0) >= 70;
                    $statusClass = $isPass ? 'status-pass' : 'status-fail';
                ?>
                    <tr>
                        <td>
                            <strong><?= htmlspecialchars($result['student_name']) ?></strong><br>
                            <span style="font-size: 0.85em; color: #6b7280;"><?= htmlspecialchars($result['student_id']) ?></span>
                        </td>
                        <td><?= htmlspecialchars($result['exam_title']) ?></td>
                        <td><?= htmlspecialchars($result['score']) ?> / <?= htmlspecialchars($result['total_questions']) ?></td>
                        <td><?= number_format($result['percentage'] ?? 0, 1) ?>%</td>
                        <td class="<?= $statusClass ?>"><?= $isPass ? 'Passed' : 'Failed' ?></td>
                        <td><?= date('M d, Y H:i:s', is_numeric($result['created_at']) ? $result['created_at'] : strtotime($result['created_at'] ?? 'now')) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

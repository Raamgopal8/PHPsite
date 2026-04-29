# KSR CCE Examination Portal

## 🚀 Overview
The **KSR CCE Examination Portal** is a specialized digital platform designed for the **Centre for Competitive Examinations at KSR College of Engineering**. This portal serves as a centralized hub for students preparing for prestigious competitive exams, providing a robust environment for practice, evaluation, and resource management.

The system supports a wide range of competitive categories including **GATE** (across multiple engineering departments), **TNPSC** (Group 1, 2, 4), **UPSC** (CSE, IFoS, ESE, etc.), and **Banking** (IBPS, SBI, RBI).

---

## ✨ Key Features

### 👨‍🎓 Student Module
*   **Comprehensive Dashboard:** Real-time tracking of exam attempts, scores, and upcoming countdowns.
*   **Lazy Authentication Flow:** Guests can explore exams and resources; login is only required when starting an exam or submitting results.
*   **FAQ Section:** Integrated student-focused FAQ for quick help on portal usage and exam patterns.
*   **Domain-Specific Exams:**
    *   **GATE:** Tailored portals for Civil, CSE, ECE, EEE, Mechanical, IT, AI&DS, and more.
    *   **TNPSC:** Focused preparation for Group 1, Group 2, and Group 4.
    *   **UPSC:** Dedicated sections for Civil Services, Forest Services, Engineering Services, etc.
    *   **Banking:** Specialized tracks for IBPS (PO/Clerk), SBI, and RBI exams.
*   **Real-time MCQ Interface:** Interactive examination engine with automatic timing and instant submission.
*   **Resource Library:** One-click access to specific syllabi and high-quality study materials/PDFs.
*   **Enhanced Events & Achievers:** Deep-integrated gallery showcasing student success stories and college-wide competitive events with premium visual layouts.

### 🔐 Security & Personalization
*   **Secure Authentication:** Password protection using Bcrypt hashing and heartbeat monitoring for active sessions.
*   **Password Recovery:** Integrated password reset system with secure token-based email verification.
*   **Encrypted Storage:** Secure handling of sensitive user data and credentials.

### 🛠️ Admin Module (Management Control)
*   **Advanced Analytics:** Visual dashboard showing recent login activity, top scores, and exam participation stats.
*   **Exam & Question Management:**
    *   Dynamic creation and scheduling of exams.
    *   **Automated Question Parsing:** Direct extraction of questions from text files for rapid content updates.
    *   Real-time monitoring of active exam scores via SSE (Server-Sent Events).
*   **Content CMS:** Easily upload and manage syllabi, study materials, achievement posters, and event highlights.
*   **System Tools:** Exportable login logs and scorecards (Print/PDF ready).
*   **Communication:** SMTP-powered notification system (PHPMailer) for reliable student reach-out.

---

## 💻 Tech Stack

*   **Backend:** PHP 8.2+ (Custom MVC Framework)
*   **Database:** MySQL (Cloud-hosted via Aiven)
*   **Frontend:** HTML5, Tailwind CSS, Javascript (Vanilla + Alpine.js)
*   **Mailing:** PHPMailer (SMTP Integration)
*   **Libraries:** 
    *   `Dotenv` (Environment Configuration)
    *   `PDFParser` (Study Material Processing)
    *   `Tesseract OCR` (Document Digitization)

---

## 🛠️ Installation & Setup

### Prerequisites
*   PHP 8.2 or higher
*   Composer
*   MySQL Server

### Step-by-Step Setup
1.  **Clone the Repository:**
    ```bash
    git clone [repository-url]
    cd ksrcce
    ```

2.  **Install Dependencies:**
    ```bash
    composer install
    ```

3.  **Configure Environment:**
    Create a `.env` file in the root directory and add your database and SMTP credentials:
    ```env
    DB_HOST=your_host
    DB_PORT=your_port
    DB_DATABASE=your_db
    DB_USERNAME=your_user
    DB_PASSWORD=your_pass

    SMTP_HOST=smtp.gmail.com
    SMTP_PORT=587
    SMTP_USER=your_email@gmail.com
    SMTP_PASS=your_app_password
    ```

4.  **Run the Application:**
    Using PHP's built-in server:
    ```bash
    php -S localhost:3000 -t public
    ```

### Database Connection & Docker Support
The portal supports both native and containerized database setups:
*   **Via Docker (Recommended):**
    ```bash
    # Start all services
    docker-compose up -d

    # Initial database setup
    docker exec -i ksrcce-db mysql -u root -proot cce < schema.sql
    ```
    Connect from host using `DB_PORT=33061`.
*   **Native MySQL:** If running MySQL directly on your host, use `DB_PORT=3306`.
*   **Inside Docker:** Services communicate via `DB_HOST=db`.

Ensure your `.env` file matches your chosen setup.

---

## 👥 Default Login Details (Development)

| User Type | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `headcce@ksrce.ac.in` | `newpassword123` |
| **Student** | `student@ksriet.ac.in` | `student` |

---

## 📄 License & Contact
For clarifications or support regarding the portal, please contact the **Head of CCE** at [headcce@ksrce.ac.in](mailto:headcce@ksrce.ac.in).

&copy; 2026 KSR College of Engineering. All rights reserved.

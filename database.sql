CREATE TABLE Professor (
    ssn INT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    salary INT,
    sex ENUM('male', 'female'),
    title VARCHAR(100),
    area_code TINYINT,
    phone_number_end VARCHAR(10),
    street VARCHAR(20),
    city VARCHAR(20),
    us_state VARCHAR(20),
    zip_code INT
);

CREATE TABLE CollegeDegrees (
    pssn INT,
    college_degree VARCHAR(50) NOT NULL,
    PRIMARY KEY (pssn, college_degree),
    FOREIGN KEY (pssn) REFERENCES Professor(ssn) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Department (
    dnum INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(20),
    telephone_number VARCHAR(20),
    office_location VARCHAR(30),
    chairperson_ssn INT,
    FOREIGN KEY (chairperson_ssn) REFERENCES Professor(ssn) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Student (
    cwid INT PRIMARY KEY,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    address VARCHAR(100),
    telephone_number VARCHAR(20),
    major_department_id INT,
    FOREIGN KEY (major_department_id) REFERENCES Department(dnum) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Minors (
    student_id INT,
    minor_department_id INT,
    PRIMARY KEY (student_id, minor_department_id),
    FOREIGN KEY (student_id) REFERENCES Student(cwid) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (minor_department_id) REFERENCES Department(dnum) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Course (
    course_number INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    textbook VARCHAR(100),
    units INT NOT NULL,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES Department(dnum) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE CourseSection (
    section_number INT,
    course_number INT,
    PRIMARY KEY (course_number, section_number),
    begin_time TIME,
    end_time TIME,
    number_of_seats INT,
    classroom VARCHAR(30) NOT NULL,
    pssn INT,
    FOREIGN KEY (pssn) REFERENCES Professor(ssn) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (course_number) REFERENCES Course(course_number) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Enrollment (
    cwid INT,
    course_number INT,
    section_number INT,
    PRIMARY KEY (cwid, course_number, section_number),
    grade ENUM('A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F'),
    FOREIGN KEY (cwid) REFERENCES Student(cwid) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (course_number, section_number) REFERENCES CourseSection(course_number, section_number) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Prerequisites (
    prerequisite INT,
    course_number INT,
    PRIMARY KEY (course_number, prerequisite),
    FOREIGN KEY (prerequisite) REFERENCES Course(course_number) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (course_number) REFERENCES Course(course_number) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE MeetingDays (
    course_number INT,
    section_number INT,
    meeting_day ENUM('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday') NOT NULL,
    PRIMARY KEY (course_number, section_number, meeting_day),
    FOREIGN KEY (course_number, section_number) REFERENCES CourseSection(course_number, section_number) ON DELETE CASCADE ON UPDATE CASCADE
);

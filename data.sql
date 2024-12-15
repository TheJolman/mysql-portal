-- Insert data into Professor table
INSERT INTO Professor (ssn, name, salary, sex, title, area_code, phone_number_end, street, city, us_state, zip_code)
VALUES
(1, 'John Doe', 60000, 'male', 'Professor', 123, '4567', '123 Elm St', 'Springfield', 'IL', 62701),
(2, 'Jane Smith', 65000, 'female', 'Associate Professor', 124, '8901', '456 Oak St', 'Springfield', 'IL', 62702),
(3, 'Mike Johnson', 70000, 'male', 'Assistant Professor', 125, '2345', '789 Pine St', 'Chicago', 'IL', 60601);

-- Insert data into Department table
INSERT INTO Department (department_name, telephone_number, office_location, chairperson_ssn)
VALUES
('Computer Science', '123-456-7890', 'Building A, Room 101', 1),
('Mathematics', '987-654-3210', 'Building B, Room 202', 2);

-- Insert data into Student table
INSERT INTO Student (cwid, first_name, last_name, address, telephone_number, major_department_id)
VALUES
(1001, 'Alice', 'Brown', '789 Maple St', '555-1234', 1),
(1002, 'Bob', 'Davis', '123 Birch St', '555-5678', 1),
(1003, 'Charlie', 'Evans', '456 Cedar St', '555-8765', 1),
(1004, 'David', 'Clark', '789 Oak St', '555-4321', 2),
(1005, 'Emily', 'Morris', '123 Pine St', '555-8765', 2),
(1006, 'Fiona', 'Wilson', '456 Elm St', '555-1234', 2),
(1007, 'George', 'White', '789 Walnut St', '555-5678', 1),
(1008, 'Hannah', 'Taylor', '123 Maple St', '555-4321', 2);

-- Insert data into Course table
INSERT INTO Course (title, textbook, units, department_id)
VALUES
('Intro to Computer Science', 'CS Book 101', 3, 1),
('Data Structures', 'CS Book 102', 4, 1),
('Calculus I', 'Math Book 101', 3, 2),
('Linear Algebra', 'Math Book 102', 3, 2);

-- Insert data into CourseSection table (must be done before Enrollment)
INSERT INTO CourseSection (section_number, course_number, begin_time, end_time, number_of_seats, classroom, pssn)
VALUES
(1, 1, '09:00:00', '10:30:00', 30, 'Room 101', 1),
(2, 1, '11:00:00', '12:30:00', 30, 'Room 101', 2),
(1, 2, '09:00:00', '10:30:00', 25, 'Room 102', 1),
(2, 2, '11:00:00', '12:30:00', 25, 'Room 102', 2),
(1, 3, '09:00:00', '10:30:00', 35, 'Room 201', 3),
(2, 3, '11:00:00', '12:30:00', 35, 'Room 201', 3);

-- Now, ensure Enrollment references only valid CourseSection pairs
INSERT INTO Enrollment (cwid, section_number, course_number, grade)
VALUES
(1008, 1, 1, 'A'),
(1002, 1, 1, 'B'),
(1003, 1, 2, 'A-'),
(1007, 2, 1, 'B+'),
(1005, 2, 2, 'A'),
(1006, 2, 1, 'B'),
(1007, 2, 3, 'C+'),
(1008, 2, 2, 'B+'),
(1001, 2, 2, 'C'),
(1002, 2, 1, 'A-'),
(1003, 2, 3, 'B'),
(1004, 1, 1, 'A'),
(1005, 1, 3, 'A'),
(1006, 2, 2, 'B-'),
(1007, 1, 3, 'A-'),
(1008, 1, 3, 'C+'),
(1001, 1, 1, 'A'),
(1002, 2, 2, 'C'),
(1005, 1, 1, 'B'),
(1004, 2, 1, 'D+');

INSERT INTO MeetingDays (section_number, course_number, meeting_day)
VALUES
(1, 1, 'Monday'),
(1, 1, 'Tuesday'),
(1, 2, 'Wednesday'),
(2, 1, 'Tuesday'),
(2, 1, 'Wednesday');

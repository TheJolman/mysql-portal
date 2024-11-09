CREATE DATABASE IF NOT EXISTS college

USE college

CREATE TABLE IF NOT EXISTS college_degrees (
  degree VARCHAR(50) PRIMARY KEY,
  professor_ssn CHAR(9) PRIMARY KEY REFERENCES professor(ssn),
)

CREATE TABLE IF NOT EXISTS professor (
  ssn CHAR(9) PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  salary INT NOT NULL,
  title VARCHAR(50),
  area_code CHAR(3),
  seven_digit_number CHAR(7),
  street VARCHAR(50),
  city VARCHAR(50),
  state VARCHAR(50),
  zip CHAR(5),
)

CREATE TABLE IF NOT EXISTS department (
  id CHAR(5) PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,
  office_location VARCHAR(50),
  chairperson_ssn CHAR(9) REFERENCES professor(ssn),
)

CREATE TABLE IF NOT EXISTS minors (
  student_id CHAR(9) PRIMARY KEY REFERENCES student(id),
  minor_id CHAR(5) REFERENCES department(id),
)

CREATE TABLE IF NOT EXISTS student (
  id CHAR(9) PRIMARY KEY,
  fname VARCHAR(50) NOT NULL,
  lname VARCHAR(50) NOT NULL,
  address VARCHAR(100) NOT NULL,
  phone_number VARCHAR(20),
  major_id CHAR(5) NOT NULL REFERENCES  department(id),
)

CREATE TABLE IF NOT EXISTS enrollment (
  student_id CHAR(9) PRIMARY KEY REFERENCES student(id),
  course_id CHAR(9) PRIMARY KEY REFERENCES section(course_id),
  section_id CHAR(9) PRIMARY KEY REFERENCES section(section_id),
  grade DECIMAL(5, 2),
)

CREATE TABLE IF NOT EXISTS section (
  section_id INTEGER PRIMARY KEY,
  course_id CHAR(9) PRIMARY KEY REFERENCES course(id),
  begin_time TIME NOT NULL,
  end_time TIME NOT NULL,
  number_seats INTEGER,
  classroom VARCHAR(20),
  professor_ssn CHAR(9) REFERENCES professor(ssn),
)

CREATE TABLE IF NOT EXISTS course (
  course_id CHAR(9) PRIMARY KEY,
  title VARCHAR(50) NOT NULL,
  textbook VARCHAR(100),
  units INTEGER NOT NULL,
  department_id CHAR(9) NOT NULL REFERENCES department(id),
)

CREATE TABLE IF NOT EXISTS prerequisites (
  course_id CHAR(9) PRIMARY KEY REFERENCES course(id),
  prereq_course_id CHAR(9) PRIMARY KEY REFERENCES course(id),
)

CREATE TABLE IF NOT EXISTS meeting_days (
  course_id CHAR(9) PRIMARY KEY REFERENCES course(id),
  section_id INTEGER PRIMARY KEY REFERENCES section(id),
  meeting_day INTEGER PRIMARY KEY,
)

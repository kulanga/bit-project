ALTER TABLE `courses` 
CHANGE COLUMN `status` `status` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 = active\n2 =draft\n3 = completed' ;

ALTER TABLE `assignment_submissions` 
CHANGE COLUMN `student_id` `student_user_id` INT(11) NOT NULL ;

ALTER TABLE `assignment_submissions` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;



---------- 2017 -----------------------

ALTER TABLE `staff` 
ADD COLUMN `title` VARCHAR(10) NOT NULL AFTER `admin_approval_status`;

ALTER TABLE `staff` 
CHANGE COLUMN `title` `title` VARCHAR(10) NULL DEFAULT NULL ;

ALTER TABLE `assignment_submissions` 
ADD COLUMN `score` SMALLINT NOT NULL DEFAULT 0 AFTER `date_submitted`;

ALTER TABLE `assignments` 
ADD COLUMN `is_repeat_assignment` TINYINT(1) NOT NULL DEFAULT 0 AFTER `status`,
ADD COLUMN `repeat_of_assignment_id` INT NOT NULL DEFAULT 0 AFTER `is_repeat_assignment`;

ALTER TABLE `assignments` 
CHANGE COLUMN `semester` `semester_id` INT(11) NULL DEFAULT NULL ;

ALTER TABLE `exam_result_details` 
CHANGE COLUMN `subject_id` `subject_user_id` VARCHAR(45) NOT NULL ;

ALTER TABLE `exam_results` 
CHANGE COLUMN `updated_at` `updated_at` DATETIME NOT NULL ,
ADD COLUMN `subject_id` INT(11) NOT NULL AFTER `student_id`,
ADD COLUMN `grade` VARCHAR(5) NULL DEFAULT NULL AFTER `subject_id`;

ALTER TABLE `exam_results` 
CHANGE COLUMN `grade` `grade` VARCHAR(5) NOT NULL;

ALTER TABLE `exam_results` 
CHANGE COLUMN `student_id` `student_user_id` INT(11) NOT NULL;

ALTER TABLE `exam_results` 
ADD UNIQUE INDEX `result_key` (`course_id` ASC, `semester_id` ASC, `student_user_id` ASC, `subject_id` ASC);

ALTER TABLE `exam_results` 
DROP COLUMN `updated_at`;

ALTER TABLE `exam_results` 
ADD COLUMN `year_semester` VARCHAR(10) NULL DEFAULT NULL COMMENT 'year - semester' AFTER `semester_id`;


-----------------------------2017-12-05-------------------
ALTER TABLE `courses` 
ADD UNIQUE INDEX `name` (`name` ASC);

CREATE TABLE `user_password_recoveries` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `reset_key` VARCHAR(250) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `index2` (`user_id` ASC),
  INDEX `index3` (`reset_key` ASC));


ALTER TABLE `timetables`
ADD COLUMN `semester_id` INT NOT NULL DEFAULT 0 AFTER `course_id`;

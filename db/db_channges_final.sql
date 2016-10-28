ALTER TABLE `courses` 
CHANGE COLUMN `status` `status` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 = active\n2 =draft\n3 = completed' ;

ALTER TABLE `assignment_submissions` 
CHANGE COLUMN `student_id` `student_user_id` INT(11) NOT NULL ;

ALTER TABLE `assignment_submissions` 
CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT ;



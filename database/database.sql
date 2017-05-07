SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `daxueSIS` ;
CREATE SCHEMA IF NOT EXISTS `daxueSIS` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `daxueSIS` ;

-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `userID` INT NOT NULL AUTO_INCREMENT ,
  `userEmail` VARCHAR(45) NOT NULL ,
  `userPassword` VARCHAR(256) NOT NULL ,
  `userSalt` VARCHAR(256) NOT NULL ,
  `userFirstName` VARCHAR(45) NOT NULL ,
  `userLastName` VARCHAR(45) NOT NULL ,
  `isAdmin` TINYINT(1) NULL ,
  `isTeacher` TINYINT(1) NULL ,
  `isStudent` TINYINT(1) NULL ,
  `studentID` VARCHAR(45) NULL ,
  `studentMajor` VARCHAR(256) NULL ,
  PRIMARY KEY (`userID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `schoolYear`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `schoolYear` ;

CREATE  TABLE IF NOT EXISTS `schoolYear` (
  `schoolYearID` INT NOT NULL AUTO_INCREMENT ,
  `fallSemesterStart` DATE NOT NULL ,
  `fallSemesterEnd` DATE NOT NULL ,
  `springSemesterStart` DATE NOT NULL ,
  `springSemesterEnd` DATE NOT NULL ,
  PRIMARY KEY (`schoolYearID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `classes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `classes` ;

CREATE  TABLE IF NOT EXISTS `classes` (
  `classID` INT NOT NULL AUTO_INCREMENT ,
  `className` VARCHAR(45) NOT NULL ,
  `classTeacherID` INT NOT NULL ,
  `schoolYearID` INT NOT NULL ,
  `classStartTime` TIME NOT NULL ,
  `classEndTime` TIME NOT NULL ,
  PRIMARY KEY (`classID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `studentClassIDs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studentClassIDs` ;

CREATE  TABLE IF NOT EXISTS `studentClassIDs` (
  `studentID` INT NOT NULL ,
  `classID` INT NOT NULL )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `grades`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `grades` ;

CREATE  TABLE IF NOT EXISTS `grades` (
  `gradeID` INT NOT NULL AUTO_INCREMENT ,
  `gradeClassID` INT NOT NULL ,
  `gradeAssignmentID` INT NOT NULL ,
  `gradeAssignmentPointsScored` DOUBLE NOT NULL ,
  `gradeStudentID` INT NOT NULL ,
  PRIMARY KEY (`gradeID`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `assignments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `assignments` ;

CREATE  TABLE IF NOT EXISTS `assignments` (
  `assignmentID` INT NOT NULL AUTO_INCREMENT ,
  `assignmentClassID` INT NOT NULL ,
  `assignmentName` VARCHAR(256) NOT NULL ,
  `assignmentPointsPossible` DOUBLE NOT NULL ,
  PRIMARY KEY (`assignmentID`) )
ENGINE = InnoDB;

USE `daxueSIS` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
USE `daxueSIS`;
INSERT INTO `users` (`userID`, `userEmail`, `userPassword`, `userSalt`, `userFirstName`, `userLastName`, `isAdmin`, `isTeacher`, `isStudent`, `studentID`, `studentMajor`) VALUES (1, 'tpostma@lssu.edu', '506beb3bb6a2c033392158f6451e85d5862b9997c999a3438cd3c4e93d65e7bf5b205f5cd132724f1db7ef9bd94088a72f9b9417c829cf081fffc3c2c599496f', '46d5eb8476b910c3501188f91f4fedfd593d8a7b13c27e25c34fd683297f43fd79f4f79cd87c9eaccdee8ed636adef49a461f1591013c7face1081191f5deb38', 'Tyler', 'Postma', 1, 1, 0, NULL, NULL);
INSERT INTO `users` (`userID`, `userEmail`, `userPassword`, `userSalt`, `userFirstName`, `userLastName`, `isAdmin`, `isTeacher`, `isStudent`, `studentID`, `studentMajor`) VALUES (2, 'student@localhost.com', '506beb3bb6a2c033392158f6451e85d5862b9997c999a3438cd3c4e93d65e7bf5b205f5cd132724f1db7ef9bd94088a72f9b9417c829cf081fffc3c2c599496f', '46d5eb8476b910c3501188f91f4fedfd593d8a7b13c27e25c34fd683297f43fd79f4f79cd87c9eaccdee8ed636adef49a461f1591013c7face1081191f5deb38', 'Student', 'Test', 0, 0, 1, '1234567890', 'International Business');

COMMIT;

-- -----------------------------------------------------
-- Data for table `schoolYear`
-- -----------------------------------------------------
START TRANSACTION;
USE `daxueSIS`;
INSERT INTO `schoolYear` (`schoolYearID`, `fallSemesterStart`, `fallSemesterEnd`, `springSemesterStart`, `springSemesterEnd`) VALUES (1, '2016-08-29', '2017-01-16', '2017-02-10', '2017-08-29');

COMMIT;

-- -----------------------------------------------------
-- Data for table `classes`
-- -----------------------------------------------------
START TRANSACTION;
USE `daxueSIS`;
INSERT INTO `classes` (`classID`, `className`, `classTeacherID`, `schoolYearID`, `classStartTime`, `classEndTime`) VALUES (1, 'English Speaking', 1, 1, '08:00:00', '08:50:00');
INSERT INTO `classes` (`classID`, `className`, `classTeacherID`, `schoolYearID`, `classStartTime`, `classEndTime`) VALUES (2, 'Online Reading', 1, 1, '09:00:00', '09:50:00');
INSERT INTO `classes` (`classID`, `className`, `classTeacherID`, `schoolYearID`, `classStartTime`, `classEndTime`) VALUES (3, 'Marketing', 1, 1, '10:00:00', '10:50:00');
INSERT INTO `classes` (`classID`, `className`, `classTeacherID`, `schoolYearID`, `classStartTime`, `classEndTime`) VALUES (4, 'Spanish Language', 1, 1, '11:00:00', '11:50:00');
INSERT INTO `classes` (`classID`, `className`, `classTeacherID`, `schoolYearID`, `classStartTime`, `classEndTime`) VALUES (5, 'Spanish Culture', 1, 1, '13:00:00', '13:50:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `studentClassIDs`
-- -----------------------------------------------------
START TRANSACTION;
USE `daxueSIS`;
INSERT INTO `studentClassIDs` (`studentID`, `classID`) VALUES (1, 1);
INSERT INTO `studentClassIDs` (`studentID`, `classID`) VALUES (1, 2);
INSERT INTO `studentClassIDs` (`studentID`, `classID`) VALUES (1, 3);
INSERT INTO `studentClassIDs` (`studentID`, `classID`) VALUES (1, 4);
INSERT INTO `studentClassIDs` (`studentID`, `classID`) VALUES (1, 5);

COMMIT;

-- -----------------------------------------------------
-- Data for table `grades`
-- -----------------------------------------------------
START TRANSACTION;
USE `daxueSIS`;
INSERT INTO `grades` (`gradeID`, `gradeClassID`, `gradeAssignmentID`, `gradeAssignmentPointsScored`, `gradeStudentID`) VALUES (1, 1, 1, 50, 1);
INSERT INTO `grades` (`gradeID`, `gradeClassID`, `gradeAssignmentID`, `gradeAssignmentPointsScored`, `gradeStudentID`) VALUES (2, 2, 2, 20, 1);
INSERT INTO `grades` (`gradeID`, `gradeClassID`, `gradeAssignmentID`, `gradeAssignmentPointsScored`, `gradeStudentID`) VALUES (3, 3, 3, 80, 1);
INSERT INTO `grades` (`gradeID`, `gradeClassID`, `gradeAssignmentID`, `gradeAssignmentPointsScored`, `gradeStudentID`) VALUES (4, 4, 4, 90, 1);
INSERT INTO `grades` (`gradeID`, `gradeClassID`, `gradeAssignmentID`, `gradeAssignmentPointsScored`, `gradeStudentID`) VALUES (5, 5, 5, 4, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `assignments`
-- -----------------------------------------------------
START TRANSACTION;
USE `daxueSIS`;
INSERT INTO `assignments` (`assignmentID`, `assignmentClassID`, `assignmentName`, `assignmentPointsPossible`) VALUES (1, 1, 'Speech 1', 50);
INSERT INTO `assignments` (`assignmentID`, `assignmentClassID`, `assignmentName`, `assignmentPointsPossible`) VALUES (2, 2, 'Reading Test', 20);
INSERT INTO `assignments` (`assignmentID`, `assignmentClassID`, `assignmentName`, `assignmentPointsPossible`) VALUES (3, 3, 'Marketing Language', 80);
INSERT INTO `assignments` (`assignmentID`, `assignmentClassID`, `assignmentName`, `assignmentPointsPossible`) VALUES (4, 4, 'Language heh', 100);
INSERT INTO `assignments` (`assignmentID`, `assignmentClassID`, `assignmentName`, `assignmentPointsPossible`) VALUES (5, 5, 'Culture', 5);

COMMIT;

-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2015 at 07:10 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tw`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `assign_id` int(5) NOT NULL AUTO_INCREMENT,
  `assign_title` varchar(25) NOT NULL,
  `assign_total` int(3) NOT NULL,
  `assign_sub_date` varchar(25) NOT NULL,
  `cf_id` int(5) NOT NULL,
  PRIMARY KEY (`assign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `assignment`
--


-- --------------------------------------------------------

--
-- Table structure for table `assignment_student`
--

CREATE TABLE IF NOT EXISTS `assignment_student` (
  `as_id` int(5) NOT NULL AUTO_INCREMENT,
  `marks` int(5) NOT NULL,
  `assign_id` int(5) NOT NULL,
  `to_id` int(5) NOT NULL,
  PRIMARY KEY (`as_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `assignment_student`
--


-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `att_id` int(5) NOT NULL AUTO_INCREMENT,
  `u_id` int(5) NOT NULL,
  `a_date` varchar(25) NOT NULL,
  `a_time` varchar(25) NOT NULL,
  `a_status` varchar(25) NOT NULL,
  `cf_id` int(3) NOT NULL,
  PRIMARY KEY (`att_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`att_id`, `u_id`, `a_date`, `a_time`, `a_status`, `cf_id`) VALUES
(24, 20, '2015-12-01', '11:34 PM ', 'P', 4),
(23, 9, '2015-12-01', '11:34 PM ', 'P', 4),
(22, 10, '2015-12-01', '11:34 PM ', 'P', 4),
(21, 20, '2015-12-01', '11:31 PM ', 'P', 4),
(20, 9, '2015-12-01', '11:31 PM ', 'P', 4),
(19, 10, '2015-12-01', '11:31 PM ', 'P', 4);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `c_id` int(5) NOT NULL AUTO_INCREMENT,
  `programm_name` text NOT NULL,
  `batch_name` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`c_id`, `programm_name`, `batch_name`, `start_date`, `end_date`) VALUES
(1, 'BS(CS)', 'FBAS/BSCS/F15', '2015-10-01', '2015-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `c_code` int(11) NOT NULL AUTO_INCREMENT,
  `c_title` varchar(25) NOT NULL,
  `c_hours` int(11) NOT NULL,
  `batch` varchar(25) NOT NULL,
  `program` varchar(25) NOT NULL,
  `c_id` int(5) NOT NULL,
  PRIMARY KEY (`c_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`c_code`, `c_title`, `c_hours`, `batch`, `program`, `c_id`) VALUES
(1, 'test', 3, 'f16', 'bs', 1),
(2, 'Holiday', 3, 'F12', 'BS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_file`
--

CREATE TABLE IF NOT EXISTS `course_file` (
  `cf_id` int(5) NOT NULL AUTO_INCREMENT,
  `u_id` int(5) NOT NULL,
  `c_code` int(5) NOT NULL,
  `c_description` varchar(25) DEFAULT NULL,
  `scheme_of_study` varchar(25) DEFAULT NULL,
  `break_out` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`cf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `course_file`
--

INSERT INTO `course_file` (`cf_id`, `u_id`, `c_code`, `c_description`, `scheme_of_study`, `break_out`) VALUES
(4, 21, 1, NULL, NULL, NULL),
(3, 21, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE IF NOT EXISTS `course_student` (
  `cs_id` int(5) NOT NULL AUTO_INCREMENT,
  `c_id` int(5) NOT NULL,
  `u_id` int(5) NOT NULL,
  `teacher` int(3) NOT NULL DEFAULT '0',
  `course` int(3) NOT NULL DEFAULT '0',
  `com_a` text NOT NULL,
  `com_b` text NOT NULL,
  `com_c` text NOT NULL,
  `com_d` text NOT NULL,
  `com_e` text NOT NULL,
  `com_f` text NOT NULL,
  `com_g` text NOT NULL,
  `com_h` text NOT NULL,
  PRIMARY KEY (`cs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `course_student`
--

INSERT INTO `course_student` (`cs_id`, `c_id`, `u_id`, `teacher`, `course`, `com_a`, `com_b`, `com_c`, `com_d`, `com_e`, `com_f`, `com_g`, `com_h`) VALUES
(9, 3, 20, 0, 0, '', '', '', '', '', '', '', ''),
(8, 4, 10, 0, 0, '', '', '', '', '', '', '', ''),
(7, 4, 9, 0, 0, '', '', '', '', '', '', '', ''),
(6, 4, 20, 0, 0, '', '', '', '', '', '', '', ''),
(10, 3, 9, 0, 0, '', '', '', '', '', '', '', ''),
(11, 3, 10, 0, 0, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `c_officer`
--

CREATE TABLE IF NOT EXISTS `c_officer` (
  `c_o_id` int(5) NOT NULL AUTO_INCREMENT,
  `c_o_designation` varchar(252) NOT NULL,
  `c_o_shif` varchar(25) NOT NULL,
  `u_id` int(3) NOT NULL,
  PRIMARY KEY (`c_o_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `c_officer`
--

INSERT INTO `c_officer` (`c_o_id`, `c_o_designation`, `c_o_shif`, `u_id`) VALUES
(1, 'ABC', 'Morning', 1);

-- --------------------------------------------------------

--
-- Table structure for table `final`
--

CREATE TABLE IF NOT EXISTS `final` (
  `f_id` int(5) NOT NULL AUTO_INCREMENT,
  `f_date` varchar(25) NOT NULL,
  `f_total` int(3) NOT NULL,
  `cf_id` int(5) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `final`
--


-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE IF NOT EXISTS `information` (
  `i_id` int(3) NOT NULL AUTO_INCREMENT,
  `cf_id` int(5) NOT NULL,
  `full` int(3) NOT NULL DEFAULT '0',
  `part` int(3) NOT NULL DEFAULT '0',
  `male` int(3) NOT NULL DEFAULT '0',
  `fmale` int(3) NOT NULL DEFAULT '0',
  `disable` int(3) NOT NULL DEFAULT '0',
  `less` int(3) NOT NULL DEFAULT '0',
  `bet` int(3) NOT NULL DEFAULT '0',
  `over` int(3) NOT NULL DEFAULT '0',
  `distance` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`i_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`i_id`, `cf_id`, `full`, `part`, `male`, `fmale`, `disable`, `less`, `bet`, `over`, `distance`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE IF NOT EXISTS `meeting` (
  `m_id` int(5) NOT NULL AUTO_INCREMENT,
  `m_date` varchar(25) NOT NULL,
  `m_agenda` varchar(25) NOT NULL,
  `st_time` varchar(25) NOT NULL,
  `app_end_time` varchar(25) NOT NULL,
  `c_o_id` int(5) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `meeting`
--


-- --------------------------------------------------------

--
-- Table structure for table `midterm`
--

CREATE TABLE IF NOT EXISTS `midterm` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_date` varchar(25) NOT NULL,
  `m_total` int(3) NOT NULL,
  `cf_id` int(5) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `midterm`
--


-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `n_id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(25) NOT NULL,
  `teacher` tinyint(1) NOT NULL DEFAULT '0',
  `student` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`n_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notification`
--


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `p_id` int(5) NOT NULL AUTO_INCREMENT,
  `p_sub_date` varchar(25) NOT NULL,
  `p_total` int(5) NOT NULL,
  `cf_id` int(5) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`p_id`, `p_sub_date`, `p_total`, `cf_id`) VALUES
(1, '12/02/2015', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE IF NOT EXISTS `qualification` (
  `qt_id` int(5) NOT NULL AUTO_INCREMENT,
  `u_id` int(5) NOT NULL,
  `degree` varchar(25) NOT NULL,
  `institute` varchar(25) NOT NULL,
  `division` varchar(25) NOT NULL,
  `percentage` varchar(252) NOT NULL,
  `cgpa` varchar(25) NOT NULL,
  PRIMARY KEY (`qt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `qualification`
--


-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `q_id` int(5) NOT NULL AUTO_INCREMENT,
  `q_date` varchar(25) NOT NULL,
  `q_total` int(3) NOT NULL,
  `cf_id` int(11) NOT NULL,
  PRIMARY KEY (`q_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quizzes`
--


-- --------------------------------------------------------

--
-- Table structure for table `quiz_student`
--

CREATE TABLE IF NOT EXISTS `quiz_student` (
  `qs_id` int(5) NOT NULL AUTO_INCREMENT,
  `marks` varchar(5) NOT NULL,
  `q_id` int(5) NOT NULL,
  `to_id` int(5) NOT NULL,
  PRIMARY KEY (`qs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quiz_student`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `r_id` int(3) NOT NULL AUTO_INCREMENT,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`r_id`, `role`) VALUES
(1, 'Admin'),
(2, 'Teacher'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `Reg_no` varchar(20) NOT NULL,
  `s_dob` date NOT NULL,
  `s_address` text NOT NULL,
  `s_cnic` varchar(15) NOT NULL,
  `s_phone` bigint(11) unsigned zerofill NOT NULL,
  `s_nationality` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pakistan',
  `s_cgpa` varchar(4) NOT NULL DEFAULT '0.00',
  `u_id` int(3) NOT NULL,
  PRIMARY KEY (`Reg_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Reg_no`, `s_dob`, `s_address`, `s_cnic`, `s_phone`, `s_nationality`, `s_cgpa`, `u_id`) VALUES
('1122-FBAS/BS(CS)/F15', '0000-00-00', 'rrtr', '', 00000000000, 'Pakistan (â€«Ù¾Ø§Ú©Ø³ØªØ§', '4.00', 9),
('1129-FBAS/BS(CS)/F15', '0000-00-00', 'sdsd', '', 00000000000, 'Pakistan (â€«Ù¾Ø§Ú©Ø³ØªØ§', '2.33', 10),
('5649-FBAS/BS(CS)/F15', '0000-00-00', 'dfdf', '', 03425348228, 'Pakistan (â€«Ù¾Ø§Ú©Ø³ØªØ§', '3.44', 20);

-- --------------------------------------------------------

--
-- Table structure for table `student_request`
--

CREATE TABLE IF NOT EXISTS `student_request` (
  `sr_id` int(5) NOT NULL AUTO_INCREMENT,
  `u_id` int(5) NOT NULL,
  `c_code` int(5) NOT NULL,
  PRIMARY KEY (`sr_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `student_request`
--


-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `t_id` int(5) NOT NULL AUTO_INCREMENT,
  `t_office` text NOT NULL,
  `t_phone` int(11) unsigned zerofill NOT NULL,
  `final_qualification` text NOT NULL,
  `t_cnic` varchar(15) NOT NULL,
  `t_gender` varchar(6) NOT NULL DEFAULT 'Female',
  `u_id` int(3) NOT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`t_id`, `t_office`, `t_phone`, `final_qualification`, `t_cnic`, `t_gender`, `u_id`) VALUES
(2, '1st Floor nn', 03425348228, 'BS nn', '', 'Male', 21);

-- --------------------------------------------------------

--
-- Table structure for table `temp_student`
--

CREATE TABLE IF NOT EXISTS `temp_student` (
  `ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(25) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(25) NOT NULL,
  `dob` varchar(25) NOT NULL,
  `cnic` varchar(25) NOT NULL,
  `contact` int(11) unsigned zerofill NOT NULL,
  `nationality` varchar(25) NOT NULL,
  `cgpa` varchar(25) NOT NULL,
  `address` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ts_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `temp_student`
--


-- --------------------------------------------------------

--
-- Table structure for table `temp_teacher`
--

CREATE TABLE IF NOT EXISTS `temp_teacher` (
  `tt_id` int(3) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `cnic` varchar(25) DEFAULT NULL,
  `phone` int(11) unsigned zerofill NOT NULL,
  `office` varchar(25) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `qualification` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `temp_teacher`
--


-- --------------------------------------------------------

--
-- Table structure for table `temp_worker`
--

CREATE TABLE IF NOT EXISTS `temp_worker` (
  `tw_id` int(3) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(25) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `shift` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `temp_worker`
--


-- --------------------------------------------------------

--
-- Table structure for table `total`
--

CREATE TABLE IF NOT EXISTS `total` (
  `to_id` int(5) NOT NULL AUTO_INCREMENT,
  `u_id` int(5) NOT NULL,
  `m_id` int(5) DEFAULT NULL,
  `m_marks` int(5) DEFAULT NULL,
  `p_id` int(5) DEFAULT NULL,
  `p_marks` int(5) DEFAULT NULL,
  `f_id` int(5) DEFAULT NULL,
  `f_marks` int(5) DEFAULT NULL,
  PRIMARY KEY (`to_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `total`
--

INSERT INTO `total` (`to_id`, `u_id`, `m_id`, `m_marks`, `p_id`, `p_marks`, `f_id`, `f_marks`) VALUES
(1, 8, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 7, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(3) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(25) NOT NULL,
  `r_id` int(3) NOT NULL DEFAULT '3',
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `fname`, `lname`, `email`, `password`, `r_id`) VALUES
(1, 'Teacher', 'Wallet', 'admin@tw.com', 'Pakistan1', 1),
(9, 'Esra', 'Barakat', 'esraa.bscs2065@iiu.edu.pk', 'Pakistan1', 3),
(10, 'Roma', 'Rizwan', 'roma.riazawan@gmail.com', 'Pakistan1', 3),
(21, 'umair', 'yyy', 'student.tw.fourth@gmail.com', 'Pakistan1', 2),
(20, 'Umair', 'Shakir', 'mumair1992@gmail.com', 'Pakistan1', 3);

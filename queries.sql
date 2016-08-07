-- this is view for getting all the deatils of PW case , with latest update status.

CREATE OR REPLACE VIEW `v_pw_details` AS 
select
`v_latest_pw_case_status`.`risk_status` AS `risk_status`,
`v_latest_pw_case_status`.`case_status` AS `case_status`,
area.area_name AS Area,
pw. `Name`AS `Name`,
PW.PWID AS PWID,
-- pw. `MCTSID`AS `MCTSID`,
pw. `DOB`AS `DOB`,
pw. `Age`AS `Age`,
pw. `Address`AS `Address`,
pw. `Landmark`AS `Landmark`,
pw. `area_id`AS `area_id`,
pw. `pw_ph_no`AS `pw_ph_no`,
pw. `GPS_latitude`AS `GPS_latitude`,
pw. `GPS_longitude`AS `GPS_longitude`,
pw. `GPS_Altitude`AS `GPS_Altitude`,
pw. `LMP`AS `LMP`,
pw. `still_birth`AS `still_birth`,
pw. `low_birth_weight`AS `low_birth_weight`,
pw. `miscarriage`AS `miscarriage`,
pw. `blood_loss`AS `blood_loss`,
pw_updated. `ANC_visit_no`AS `ANC_visit_no`,
pw. `preg_count`AS `preg_count`,
pw_updated. `preg_mnth`AS `preg_mnth`,
pw. `primigravida`AS `primigravida`,
pw. `last_preg_gap`AS `last_preg_gap`,
pw. `pih_mother_sister`AS `pih_mother_sister`,
pw. `diabetes_mother_sister`AS `diabetes_mother_sister`,
pw. `prior_pih`AS `prior_pih`,
pw. `med_diagnosis`AS `med_diagnosis`,
pw_updated. `multi_preg`AS `multi_preg`,
pw. `c_sec`AS `c_sec`,
pw_updated. `edema`AS `edema`,
pw_updated. `headache_bluryvision`AS `headache_bluryvision`,
pw_updated. `vaginal_bleeding`AS `vaginal_bleeding`,
pw_updated. `bp_systolic`AS `bp_systolic`,
pw_updated. `bp_diastolic`AS `bp_diastolic`,
pw_updated. `mean_arterial_pressure`AS `mean_arterial_pressure`,
pw_updated. `pulse_rate`AS `pulse_rate`,
pw. `Height_mtr`AS `Height_mtr`,
pw_updated. `Curr_weight`AS `Curr_weight`,
pw. `BMI`AS `BMI`,
pw_updated. `anaemia`AS `anaemia`,
pw_updated. `HIV`AS `HIV`,
pw. `ANM_ID`AS `ANM_ID`,
timestampdiff(MONTH,`pw`.`LMP`,curdate())+1 AS `month_of_preg`,
date_format(cast(`v_latest_pw_case_status`.`next_visit_date` as date),'%e-%c-%Y') AS `DUE_DATE` 
from (`pw_reg` `pw` left join `v_latest_pw_case_status` on((`pw`.`PWID` = `v_latest_pw_case_status`.`PWID`)))
join area_details area on area.area_id = pw.area_id left join v_latest_pw_case_update pw_updated on pw.PWID = pw_updated.PWID

-- ======================================================================================================

 CREATE OR REPLACE VIEW `v_summary_report` AS 
 select `v_pw_case_latest_status`.`system_risk_status` AS `label`,
 count(0) AS `count` 
 from `v_pw_case_latest_status` group by `v_pw_case_latest_status`.`system_risk_status` 

 union 
 select 'Total_pw' AS `label`,count(0) AS `count` from `v_pw_case_latest_status`
 union
 select 'pw_due_for_visit' AS label , count(*) as count from v_pw_case_latest_status where visit_status = "DUE"
 union
 select 'pw_visited' AS label , count(*) as count from v_pw_case_latest_status where visit_status = "VISITED"

 ============================================
 create trigger assign_emp_id AFTER INSERT ON user_profile
BEGIN    
UPDATE user_profile SET user_profile.emp_id = CONCAT(NEW.emp_type,NEW.rec_id) WHERE rec_id = NEW.rec_id;  
END//

-- =======================================================================================================
----------------------------------------------
SELECT STATUS . * , pw.area_id
FROM  `v_pw_case_latest_status` 
STATUS LEFT JOIN pw_reg pw ON ( status.MCTS_ID = pw.MCTSID ) 
LIMIT 0 , 30

---------------------------------------------
summary report query

 select `v_pw_case_latest_status`.`system_risk_status` AS `label`,
 count(0) AS `count` 
 from `v_pw_case_latest_status`  where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id') group by `v_pw_case_latest_status`.`system_risk_status` 

 union 
 select 'Total_pw' AS `label`,count(0) AS `count` from `v_pw_case_latest_status` where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 union
 select 'pw_due_for_visit' AS label , count(*) as count from v_pw_case_latest_status where visit_status = "DUE" AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')
 union
 select 'pw_visited' AS label , count(*) as count from v_pw_case_latest_status where visit_status = "VISITED" AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id')

==========================================================================================

CREATE VIEW v_latest_case_status_MO AS
SELECT pw.*,DATEDIFF(pw.next_visit_date,current_date()) as days FROM `pw_case_update_mo` pw 
WHERE CONCAT(MCTSID,`Form_entry_time`) IN (SELECT CONCAT(mo.MCTSID,max(mo.Form_entry_time)) FROM pw_case_update_mo mo group by mo.MCTSID)
===========================================================================================


CREATE OR REPLACE VIEW `v_latest_pw_case_status` AS 
select `pw_case_status`.`rec_id` AS `rec_id`,
`pw_case_status`.`PWID` AS `PWID`,
-- `pw_case_status`.`MCTSID` AS `MCTSID`,
pw_reg.area_id AS area_id,
`pw_case_status`.`case_status` AS `case_status`,
`pw_case_status`.`risk_status` AS `risk_status`,
`pw_case_status`.`updated_by` AS `updated_by`,
`pw_case_status`.`risk_reason` AS `risk_reason`,
`pw_case_status`.`next_visit_date` AS `next_visit_date`,
`pw_case_status`.`remark` AS `remark`,
`pw_case_status`.`Time_stamp` AS `Time_stamp` 
from `pw_case_status` left join pw_reg on pw_case_status.PWID = pw_reg.PWID
where concat(`pw_case_status`.`PWID`,`pw_case_status`.`Time_stamp`) in (select concat(`pw_case_status`.`PWID`,max(`pw_case_status`.`Time_stamp`)) 
from `pw_case_status` group by `pw_case_status`.`PWID`)

==========================================================================================
-- query for getting summarised result according to employee id
 select `v_latest_pw_case_status`.`risk_status` AS `label`,
 count(*) AS `count` 
 from `v_latest_pw_case_status`  where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = 'ANM1') group by `v_latest_pw_case_status`.`risk_status` 

 union 
 select 'Total_pw' AS `label`,count(*) AS `count` from `v_latest_pw_case_status` where area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = 'ANM1')
 union
 select 'pw_due_for_visit' AS label , count(*) as count from v_latest_pw_case_status where (case_status = 'DUE' OR case_status = 'VISITED_NEXT_DATE') AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = 'ANM1')
 union
 select 'pw_visited' AS label , count(*) as count from v_latest_pw_case_status where case_status = 'VISITED' AND  area_id IN (select emp.area_id from emp_area emp WHERE emp.emp_id = 'ANM1')
 
 ===========================================================================================
 -- query for getting latest pw_updated record
 
CREATE OR REPLACE VIEW `v_latest_pw_case_update` AS 
select pw_case_update.* 
from `pw_case_update` where concat(`pw_case_update`.`PWID`,`pw_case_update`.`Form_entry_time`) in (select concat(`pw_case_update`.`PWID`,max(`pw_case_update`.`Form_entry_time`)) 
from `pw_case_update` group by `pw_case_update`.`PWID`)
===========================================================================================
-- this is view for getting all the deatils of PW case , with latest update status.

CREATE OR REPLACE VIEW `v_pw_details` AS 
select
`v_pw_case_latest_status`.`system_risk_status` AS `system_risk_status`,
`v_pw_case_latest_status`.`visit_status` AS `visit_status`,
 pw.`Name` AS  `Name`,
pw.`MCTSID` AS  `MCTSID`,
pw.`DOB` AS  `DOB`,
pw.`Age` AS  `Age`,
pw.`Socio_Eco_Status` AS  `Socio_Eco_Status`,
pw.`Address` AS  `Address`,
pw.`Landmark` AS  `Landmark`,
pw.`area_id` AS  `area_id`,
area.area_name AS Area,
pw.`pw_ph_no` AS  `pw_ph_no`,
pw.`GPS_latitude` AS  `GPS_latitude`,
pw.`GPS_longitude` AS  `GPS_longitude`,
pw.`GPS_Altitude` AS  `GPS_Altitude`,
pw.`LMP` AS  `LMP`,
pw.`ANC_visit_no` AS  `ANC_visit_no`,
pw.`preg_count` AS  `preg_count`,
pw.`succ_preg_count` AS  `succ_preg_count`,
pw.`preg_mnth` AS  `preg_mnth`,
pw.`doc_visit` AS  `doc_visit`,
pw.`primigravida` AS  `primigravida`,
pw.`nulloparous` AS  `nulloparous`,
pw.`last_preg_gap` AS  `last_preg_gap`,
pw.`pih_mother` AS  `pih_mother`,
pw.`have_sister` AS  `have_sister`,
pw.`pih_sister` AS  `pih_sister`,
pw.`prior_pih` AS  `prior_pih`,
pw.`last_preg_status` AS  `last_preg_status`,
pw.`med_diagnosis` AS  `med_diagnosis`,
pw.`IVF_his` AS  `IVF_his`,
pw.`chronic_bp` AS  `chronic_bp`,
pw.`Diabetes_his` AS  `Diabetes_his`,
pw.`c_sec` AS  `c_sec`,
pw.`edema` AS  `edema`,
pw.`multiparous` AS  `multiparous`,
pw.`nausea_vomiting` AS  `nausea_vomiting`,
pw.`bp_systolic` AS  `bp_systolic`,
pw.`bp_diastolic` AS  `bp_diastolic`,
pw.`mean_arterial_pressure` AS  `mean_arterial_pressure`,
pw.`pulse_rate` AS  `pulse_rate`,
pw.`Height_mtr` AS  `Height_mtr`,
pw.`Curr_weight` AS  `Curr_weight`,
pw.`BMI` AS  `BMI`,
timestampdiff(MONTH,`pw`.`LMP`,curdate())+1 AS `month_of_preg`,
date_format(cast(`v_pw_case_latest_status`.`Time_stamp` as date),'%e-%c-%Y') AS `Time_stamp` 
from (`pw_reg` `pw` left join `v_pw_case_latest_status` on((`pw`.`MCTSID` = `v_pw_case_latest_status`.`MCTS_ID`)))
join area_details area on area.area_id = pw.area_id

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

CREATE OR REPLACE view  `v_pw_case_latest_status` AS 
select `pw_case_status_system`.`rec_id` AS `rec_id`,
`pw_case_status_system`.`MCTS_ID` AS `MCTS_ID`,
`pw_case_status_system`.`system_risk_status` AS `system_risk_status`,
`pw_case_status_system`.`risk_reason` AS `risk_reason`,
`pw_case_status_system`.`visit_status` AS `visit_status`,
pw.area_id AS area_id,
max(`pw_case_status_system`.`Time_stamp`) AS `Time_stamp` 
from `pw_case_status_system` left join pw_reg pw on pw.MCTSID = pw_case_status_system.MCTS_ID
group by `pw_case_status_system`.`MCTS_ID` order by `pw_case_status_system`.`rec_id`

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

select emp.area_id from emp_area emp WHERE emp.emp_id = '$emp_id'
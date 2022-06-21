WITH Credits AS (SELECT stud_id,
             year, 
             sum(credits) AS credits
      FROM Takes T, Class C
      WHERE T.class_id = C.id
      GROUP BY stud_id)
SELECT id,
    COALESCE(tot_cred - credits, 0) AS credit_discrepency
FROM Student, Credits
WHERE Credits.stud_id = Student.id;
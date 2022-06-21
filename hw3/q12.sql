WITH Credits AS (SELECT stud_id,
             year, 
             sum(credits) AS credits
      FROM Takes T, Class C
      WHERE T.class_id = C.id
      GROUP BY stud_id, year) 
SELECT C.stud_id, C.year
FROM Credits C, (
    SELECT stud_id, 
           MAX(credits) AS max_credit 
    FROM Credits
    GROUP BY stud_id
) MC 
WHERE C.stud_id = MC.stud_id and C.credits = MC.max_credit;

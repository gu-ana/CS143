WITH Credits AS (SELECT stud_id,
             year, 
             sum(credits) AS credits
      FROM Takes T, Class C
      WHERE T.class_id = C.id
      GROUP BY stud_id)
SELECT stud_id, 
       credits
    FROM Credits
GROUP BY stud_id
ORDER BY credits DESC
LIMIT 0,4;
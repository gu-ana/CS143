SELECT student_name, advisor_name
FROM (Student S 
      Left Join advisor A ON S.id = A.sid
      LEFT JOIN instructor I ON A.aid = I.id)
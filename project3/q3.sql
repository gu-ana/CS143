 SELECT familyName FROM Laureate NATURAL JOIN Prize GROUP BY familyName HAVING COUNT(DISTINCT id) >= 5;

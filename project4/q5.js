db.laureates.aggregate(
    {$unwind: "$nobelPrizes"},
//    {$unwind: "$nobelPrizes.affiliations"},
    {$match:
     { "orgName": {$exists: true}}
    },
     {$group:
      {
     	 _id:"$nobelPrizes.awardYear",
     	 total: {$sum: 1}
      }
     },
    {$group:
     {
	 _id:"years",
	 years: {$sum: 1}
     }
    },
    {$project:{_id:0}}
)

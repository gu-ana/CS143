db.laureates.aggregate(
    {$unwind: "$nobelPrizes"},
    {$unwind: "$nobelPrizes.affiliations"},
    {$match:
     { "nobelPrizes.affiliations.name.en": "University of California"}
    },
    {$group: {"_id": {city:"$nobelPrizes.affiliations.city.en",
		      country:"$nobelPrizes.affiliations.country.en"}},
    },
    {$group: {"_id": "huh", total: {$sum: 1}}},
    {$project: {locations:"$total", _id:0}}
     
)

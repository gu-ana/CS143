db.laureates.aggregate(
    
    { $group: {
	_id: "$familyName.en",
	count: {$sum: 1}
    }},
    {$sort: {
	count: -1
    }
    },
    { $match: { count : { $eq : 5}}},
    { $project : {familyName:"$_id", _id:0}}
    
)

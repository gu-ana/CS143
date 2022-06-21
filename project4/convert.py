import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))
write_to = open("./laureates.import", "w")

# get the id, givenName, and familyName of the first laureate
for laureate in data["laureates"]:
    write_to.write(json.dumps(laureate)+'\n')
#close file
write_to.close()

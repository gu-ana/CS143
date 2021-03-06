import json

# load data
data = json.load(open("/home/cs143/data/nobel-laureates.json", "r"))
laureate_file = open("./laureate.del", "w")
org_file = open("./org.del", "w")
prize_file = open("./prize.del", "w")
# get the id, givenName, and familyName of the first laureate
total = 0
for laureate in data["laureates"]:
    id = laureate["id"]
    if "orgName" not in laureate:
        #they are a person
        # givenName = if laureate["givenName"]["en"] in laureate else ""
        # familyName = if laureate["familyName"]["en"] in laureate else ""
        # gender = if laureate["gender"] in laureate else ""
        # birth_date = if laureate["birth"]["date"] in laureate else ""
        # birth_city = if laureate["birth"]["place"]["city"]["en"] in laureate else ""
        # birth_country = if laureate["birth"]["place"]["country"]["en"] in laureate else ""

        givenName = laureate["givenName"]["en"] if "givenName" in laureate else "NULL"
        familyName = laureate["familyName"]["en"] if "familyName" in laureate else "NULL"
        gender = laureate["gender"] if "gender" in laureate else "NULL"
        birth_date = "NULL"
        birth_city = "NULL"
        birth_country = "NULL"
        if "birth" in laureate:
            birth_date = laureate["birth"]["date"] if "date" in laureate["birth"] else "NULL"
            if "place" in laureate["birth"]:
                birth_city = laureate["birth"]["place"]["city"]["en"] if "city" in laureate["birth"]["place"] else "NULL"
                birth_country = laureate["birth"]["place"]["country"]["en"] if "country" in laureate["birth"]["place"] else "NULL" 
        laureate_file.write(f'{id},"{givenName}","{familyName}",{gender},{birth_date},"{birth_city}","{birth_country}"\n')
        for nobel_prize in laureate["nobelPrizes"]:
            award_year = nobel_prize["awardYear"]
            category = nobel_prize["category"]["en"]
            sort_order = nobel_prize["sortOrder"]
            if 'affiliations' in nobel_prize:
                for affiliation in nobel_prize["affiliations"]:
                    affiliations_name = affiliation["name"]["en"] if 'name' in affiliation else "NULL"
                    affiliations_city = affiliation["city"]["en"] if 'city' in affiliation else "NULL" 
                    affiliations_country = affiliation["country"]["en"] if 'country' in affiliation else "NULL"
            else:
                affiliations_name = "NULL" 
                affiliations_city = "NULL" 
                affiliations_country = "NULL"                   
            prize_file.write(f'{id},{award_year},{category},{sort_order},"{affiliations_name}","{affiliations_city}","{affiliations_country}"\n')

    else:
        #they are an org
        org_name = laureate["orgName"]["en"] if "orgName" in laureate else "NULL"
        founded_date = "NULL"
        founded_city = "NULL"
        founded_country = "NULL"
        if "founded" in laureate:            
            founded_date = laureate["founded"]["date"] if "date" in laureate["founded"] else "NULL"
            if "place" in laureate["founded"]:
                founded_city = laureate["founded"]["place"]["city"]["en"] if "city" in laureate["founded"]["place"] else "NULL"
                founded_country = laureate["founded"]["place"]["country"]["en"] if "country" in laureate["founded"]["place"] else "NULL"
        org_file.write(f'{id},"{org_name}",{founded_date},"{founded_city}","{founded_country}"\n') 
        for nobel_prize in laureate["nobelPrizes"]:
            award_year = nobel_prize["awardYear"]
            category = nobel_prize["category"]["en"]
            sort_order = nobel_prize["sortOrder"]
            print(id)
            total += 1
            if 'affiliations' in nobel_prize:
                for affiliation in nobel_prize["affiliations"]:
                    affiliations_name = affiliation["name"]["en"] if 'name' in affiliation else "NULL" 
                    affiliations_city = affiliation["city"]["en"] if 'city' in affiliation else "NULL" 
                    affiliations_country = affiliation["country"]["en"] if 'country' in affiliation else "NULL"
                    prize_file.write(f"{id},{award_year},{category},{sort_order},{affiliations_name},{affiliations_city},{affiliations_country}\n")
            affiliations_name = "NULL" 
            affiliations_city = "NULL" 
            affiliations_country = "NULL"                   
            prize_file.write(f'{id},{award_year},{category},{sort_order},"{affiliations_name}","{affiliations_city}","{affiliations_country}"\n')

                    # "nobelPrizes": [{
#             "awardYear", "category", "sortOrder",
#             "affiliations": [{
#                             "name", "city", "country"
#                         }]
#         }]

print(total)
laureate_file.close()
org_file.close()
prize_file.close()

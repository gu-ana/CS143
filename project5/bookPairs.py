from pyspark import SparkContext

from itertools import combinations
sc= SparkContext("local", "bookPairs")
lines = sc.textFile("/home/cs143/data/goodreads.user.books")
#lines = sc.textFile("/home/cs143/data/goodreads.1000")
#lines = sc.textFile("/home/cs143/data/goodreads.3000")
def function(line):
    #print(line)
    ID, books = line.split(":")
    books_individual = books.split(",")
    combos = combinations(books_individual,2)
    return combos
pair = lines.flatMap(lambda line: function(line))
pairs = pair.map(lambda word: (word, 1))
pairCounts = pairs.reduceByKey(lambda a, b: a+b)
#sortedpairCounts = pairCounts.sortBy(lambda a: -a[1])
#sortedpairCounts = sortedpairCounts.filter(lambda x: x[1] > 20)
sortedpairCounts = pairCounts.filter(lambda x: x[1] > 20)
sortedpairCounts.saveAsTextFile("output")

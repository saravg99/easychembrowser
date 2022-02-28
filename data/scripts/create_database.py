import json

######## READ COMPOUND DESCRIPTIONS
file1 = open("../compound_descriptions.json", "r")

jsonfile1 = json.loads(file1.read())
jsonfile1.pop()

result_desc = []

for group in jsonfile1:
	descriptions = group["InformationList"]["Information"]
	for element in descriptions:
		if "Description" in  element:
			cid = element["CID"]
			desc = element["Description"].replace("'", "''")
			result_desc.append(tuple([str(desc), str(cid)] ))

file1.close()
###############################




######## READ COMPOUND SYNONYMS

file2 = open("../compound_synonyms.json", "r")
jsonfile2 = json.loads(file2.read())
jsonfile2.pop()

result_syn = []

for group in jsonfile2:
	synonyms = group["InformationList"]["Information"]
	for element in synonyms:
		if "Synonym" in element:
			syns = ";".join(element["Synonym"][0:10]).replace("'", "''")
			result_syn.append(tuple([str(element["CID"]), syns]))
file2.close()
#######################################

######### READ COMPOUND SOURCES

file3 = open("../compound_sources.json", "r")
jsonfile3 = json.loads(file3.read())
jsonfile3.pop()

result_sources = []

for group in jsonfile3:
	sources = group["InformationList"]["Information"]
	for element in sources:
		if "SourceName" in element:
			for name in set(element['SourceName']):
				result_sources.append(tuple([str(element["CID"]), name]))
file3.close()
#######################################


####### CONNECT TO DATABASE

import mysql.connector
import db_credentials as db

mydb = mysql.connector.connect(
	host=str(db.host),
	user=str(db.user),
	password=str(db.password),
	database=str(db.database))
############################


### FRIENDLY REMINDER: 
#   ADD COMPOUND PROPERTIES and PUBCHEM SOURCES BY HAND (importing the csv into mysql)



######### ADD COMPOUND DESCRIPTIONS

mycursor = mydb.cursor()
for element in result_desc:
	sql="UPDATE Compound SET description = '"+ element[0] +"' WHERE CID = '"+ element[1] + "'"
	#print(sql)

	mycursor.execute(sql)
	
mydb.commit()	
print("Finished adding compound descriptions")
mycursor.close()
#################################

############ ADD COMPOUND SYNONYMS

mycursor = mydb.cursor()

for element in result_syn:

	sql="UPDATE Compound SET synonyms = '"+ element[1] +"' WHERE CID = '"+ element[0] + "'"
	#print(sql)

	mycursor.execute(sql)
	
mydb.commit()
print("Finished adding compound synonyms")
mycursor.close()
###############################




############## ADD SOURCE-COMPOUND RELATIONSHIPS

mycursor = mydb.cursor()

for element in result_sources:


	sql='INSERT IGNORE INTO sources_has_Compound VALUES ("' + element[1] + '", ' + element[0] + ')'
	#print(sql)

	mycursor.execute(sql)
	
mydb.commit()
print("Finished adding source-compound relationships")
mycursor.close()
#############################

############## ADD TARGET 
protein_list = ["CFTR", "Glycophorin D", "Scramblase", "Nicotinic acetylcholine receptor", "  GABAa receptors", "Potassium channels", "Calcium channels", "Sodium channels", "Colony-stimulating factors (CSFs)", "Epidermal growth factor (EGF)", "Fibroblast growth factor (FGF)", "Platelet-derived growth factor (PDGF)", "Transforming growth factors (TGFs)", "Vascular endothelial growth factor (VEGF)", "C-myc", "FOXP2", "FOXP3", "MyoD", "P53"]

mycursor = mydb.cursor()
for element in protein_list:

	sql='INSERT INTO Target(name) VALUES ("' + element +'")'
	#print(sql)

	mycursor.execute(sql)
	
mydb.commit()	
print("Finished adding targets")
mycursor.close()
#############################


################  ADD TARGET-COMPOUND RELATIONSHIPS

import itertools
import random

num_of_compounds = 1000
num_of_proteins = 19

cids = range(1, num_of_compounds+1)
prot_ids = range(1, num_of_proteins +1)

pairs = random.sample(set(itertools.product(prot_ids, cids)), num_of_compounds*5)

mycursor = mydb.cursor()

for element in pairs:

	sql='INSERT INTO Target_has_Compound VALUES (' + str(element[0]) + ', ' + str(element[1]) + ')'
	#print(sql)

	mycursor.execute(sql)

mydb.commit()
print("Finished adding target-compound relationships")
###########################

mycursor.close()
mydb.close()
	

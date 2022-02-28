import requests
import os
import sys

pugrest = "https://pubchem.ncbi.nlm.nih.gov/rest/pug/"

def get_compound_properties(cid_list, data_folder):
	operation1 = "compound/cid/property/CanonicalSMILES,IUPACName,Title,MolecularFormula,MolecularWeight/CSV"
	url1 = pugrest + operation1
	data_file = data_folder + "compound_properties.csv"
	if os.path.exists(data_file):
		os.remove(data_file)
	cids_grouped = [cid_list[x:x+10000] for x in range(0, len(cid_list), 10000)]
	for cid_group in cids_grouped:
		cids = "cid=" + ",".join(str(e) for e in cid_group)
		r1 = requests.post(url1, data=cids)
		open(data_file, "ab").write(r1.content)
		



def get_pubchem_sources(data_folder):
	operation2 = "sourcetable/substance/CSV"
	url2 = pugrest + operation2
	data_file = data_folder + "pubchem_sources.csv"
	if not os.path.exists(data_file):
		r2 = requests.get(url2)
		open(data_file, "wb").write(r2.content)
	

	

def get_compound_sources(cid_list, data_folder):
	operation3 = "compound/cid/xrefs/SourceName/JSON"
	url3 = pugrest + operation3
	data_file = data_folder + "compound_sources.json"
	if os.path.exists(data_file):
		os.remove(data_file)
	cids_grouped = [cid_list[x:x+100] for x in range(0, len(cid_list), 100)]
	open(data_file, "ab").write(b"[")		
	for cid_group in cids_grouped:
		cids = "cid=" + ",".join(str(e) for e in cid_group)
		r3 = requests.post(url3, data=cids)
		open(data_file, "ab").write(r3.content + b",")
	open(data_file, "ab").write(b"{}]")		

	
	
	

def get_compound_synonyms(cid_list, data_folder):
	operation4 = "compound/cid/synonyms/JSON"
	url4 = pugrest + operation4
	data_file = data_folder + "compound_synonyms.json"
	if os.path.exists(data_file):
		os.remove(data_file)
	cids_grouped = [cid_list[x:x+1000] for x in range(0, len(cid_list), 1000)]	
	open(data_file, "ab").write(b"[")	
	for cid_group in cids_grouped:
		cids = "cid=" + ",".join(str(e) for e in cid_group)
		r4 = requests.post(url4, data=cids)
		open(data_file, "ab").write(r4.content + b",")
	open(data_file, "ab").write(b"{}]")	



def get_compound_dates(cid_list, data_folder):
	operation5 = "compound/cid/dates/JSON"
	url5 = pugrest + operation5
	data_file = data_folder + "compound_dates.json"
	if os.path.exists(data_file):
		os.remove(data_file)
	cids_grouped = [cid_list[x:x+10000] for x in range(0, len(cid_list), 10000)]
	open(data_file, "ab").write(b"[")	
	for cid_group in cids_grouped:
		cids = "cid=" + ",".join(str(e) for e in cid_group)
		r5 = requests.post(url5, data=cids)
		open(data_file, "ab").write(r5.content + b",")
	open(data_file, "ab").write(b"{}]")	

	
	
	

def get_compound_description(cid_list, data_folder):
	operation6 = "compound/cid/description/JSON"
	url6 = pugrest + operation6
	data_file = data_folder + "compound_descriptions.json"
	if os.path.exists(data_file):
		os.remove(data_file)
	cids_grouped = [cid_list[x:x+100] for x in range(0, len(cid_list), 100)]	
	open(data_file, "ab").write(b"[")	
	for cid_group in cids_grouped:
		cids = "cid=" + ",".join(str(e) for e in cid_group)
		r6 = requests.post(url6, data=cids)
		open(data_file, "ab").write(r6.content + b",")
	open(data_file, "ab").write(b"{}]")	




if __name__ == "__main__":
	max_cid = 1000
	cid_list = list(range(1,max_cid + 1))
	data_folder = "../"
	
	get_compound_properties(cid_list, data_folder)
	sys.stderr.write("Compound properties obtained.\n")	
	get_pubchem_sources(data_folder)
	sys.stderr.write("Pubchem sources obtained.\n")
	get_compound_sources(cid_list, data_folder)
	sys.stderr.write("Compound sources obtained. \n")
	get_compound_synonyms(cid_list, data_folder)
	sys.stderr.write("Compound synonyms obtained.\n")
	get_compound_dates(cid_list, data_folder)
	sys.stderr.write("Compound dates obtained.\n")
	get_compound_description(cid_list, data_folder)
	sys.stderr.write("Compound descriptions obtained.\n")
	sys.stderr.write("DATA OBTENTION FINISHED.\n")




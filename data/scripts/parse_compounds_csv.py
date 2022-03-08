import pandas as pd
import numpy as np

csv = pd.read_csv('../compound_properties.csv')

## add lipinsky column:

csv["lipinski"] = 0

for i in range(len(csv)):
	mw = csv.loc[i, "MolecularWeight"] 
	logp = csv.loc[i, "XLogP"]
	donors = csv.loc[i, "HBondDonorCount"]
	acceptors = csv.loc[i, "HBondAcceptorCount"]
	
	if mw < 500 and logp < 5 and donors <= 5 and acceptors <=10:
		csv.loc[i, "lipinski"] = "Yes"
	else:
		csv.loc[i, "lipinski"] = "No"	


##replace empty cells
csv = csv.fillna('NULL')

csv.to_csv('../compound_properties_parsed.csv', index=False)

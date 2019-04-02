import csv
import numpy as np

with open('DataTugas2.csv') as csvfile:
    readCSV = csv.reader(csvfile, delimiter=',')
    next(readCSV)

    pendapatan = []
    hutang = []
    for row in readCSV:
        pendapatana = row[1]
        hutanga = row[2]

        pendapatan.append(pendapatana)
        hutang.append(hutanga)

kecsv = []

nPendapatan = []
sPendatapan = []
nHutang = []
sHutang = []
hasilYa = []
hasilTidak = []


def cekPendapatan(data):
    if (data >= 0 and data <= 0.747):
        sPendatapan.append("Rendah")
        nPendapatan.append(1.0)
        # sPendatapan.append("Rendah")
        nPendapatan.append(1.0)
    elif (data > 0.747 and data <= 0.923):
        sPendatapan.append("RendahSedang")
        nPendapatan.append(-(data - 0.923) / (0.923 - 0.747))
        # sPendatapan.append("Sedang")
        nPendapatan.append((data - 0.747) / (0.923 - 0.747))
    elif (data > 0.923 and data <= 1.282):
        sPendatapan.append("Sedang")
        nPendapatan.append(1.0)
        # sPendatapan.append("Sedang")
        nPendapatan.append(1.0)
    elif (data > 1.282 and data <= 1.548):
        sPendatapan.append("SedangTinggi")
        nPendapatan.append(-(data - 1.548) / (1.548 - 1.282))
        # sPendatapan.append("Tinggi")
        nPendapatan.append((data - 1.282) / (1.548 - 1.282))
    elif (data > 1.548):
        sPendatapan.append("Tinggi")
        nPendapatan.append(1.0)
        # sPendatapan.append("Tinggi")
        nPendapatan.append(1.0)

def cekHutang(data):
    if (data >= 0 and data <= 25.246):
        sHutang.append("Rendah")
        nHutang.append(1.0)
        # sHutang.append("Rendah")
        nHutang.append(1.0)
    elif (data > 25.246 and data <= 36.429):
        sHutang.append("RendahSedang")
        nHutang.append(-(data - 36.429) / (36.429 - 25.246))
        # sHutang.append("Sedang")
        nHutang.append((data - 25.246) / (36.429 - 25.246))
    elif (data > 36.429 and data <= 45.566):
        sHutang.append("Sedang")
        nHutang.append(1.0)
        # sHutang.append("Sedang")
        nHutang.append(1.0)
    elif (data > 45.566 and data <= 61.661):
        sHutang.append("SedangTinggi")
        nHutang.append(-(data - 61.661) / (61.661 - 45.566))
        # sHutang.append("Tinggi")
        nHutang.append((data - 45.566) / (61.661 - 45.566))
    elif (data > 61.661):
        sHutang.append("Tinggi")
        nHutang.append(1.0)
        # sHutang.append("Tinggi")
        nHutang.append(1.0)

for i in range(len(pendapatan)):
    cekPendapatan(float(pendapatan[i]))
    cekHutang(float(hutang[i]))

for i in range (len(pendapatan)):
    kecsv.append([pendapatan[i],sPendatapan[i],hutang[i],sHutang[i]])

csvfile = "bacadata.csv"

with open(csvfile, "w") as output:
    writer = csv.writer(output, lineterminator='\n')
    for val in kecsv:
        writer.writerow(val)

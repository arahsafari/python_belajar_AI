import csv

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


class Fuzzy:
    def __init__(self):
        self.nPendapatan = []
        self.sPendatapan = []
        self.nHutang = []
        self.sHutang = []
        self.hasilYa = []
        self.hasilTidak = []

    def cekPendapatan(self,data):
        if (data >= 0 and data <= 0.747):
            self.sPendatapan.append("Rendah")
            self.nPendapatan.append(1.0)
            self.sPendatapan.append("Rendah")
            self.nPendapatan.append(1.0)
        elif (data > 0.747 and data <= 0.923):
            self.sPendatapan.append("Rendah")
            self.nPendapatan.append(-(data - 0.923) / (0.923 - 0.747))
            self.sPendatapan.append("Sedang")
            self.nPendapatan.append((data - 0.747) / (0.923 - 0.747))
        elif (data > 0.923 and data <= 1.282):
            self.sPendatapan.append("Sedang")
            self.nPendapatan.append(1.0)
            self.sPendatapan.append("Sedang")
            self.nPendapatan.append(1.0)
        elif (data > 1.282 and data <= 1.548):
            self.sPendatapan.append("Sedang")
            self.nPendapatan.append(-(data - 1.548) / (1.548 - 1.282))
            self.sPendatapan.append("Tinggi")
            self.nPendapatan.append((data - 1.282) / (1.548 - 1.282))
        elif (data > 1.548):
            self.sPendatapan.append("Tinggi")
            self.nPendapatan.append(1.0)
            self.sPendatapan.append("Tinggi")
            self.nPendapatan.append(1.0)

    def cekHutang(self,data):
        if (data >= 0 and data <= 25.246):
            self.sHutang.append("Rendah")
            self.nHutang.append(1.0)
            self.sHutang.append("Rendah")
            self.nHutang.append(1.0)
        elif (data > 25.246 and data <= 36.429):
            self.sHutang.append("Rendah")
            self.nHutang.append(-(data - 36.429) / (36.429 - 25.246))
            self.sHutang.append("Sedang")
            self.nHutang.append((data - 25.246) / (36.429 - 25.246))
        elif (data > 36.429 and data <= 45.566):
            self.sHutang.append("Sedang")
            self.nHutang.append(1.0)
            self.sHutang.append("Sedang")
            self.nHutang.append(1.0)
        elif (data > 45.566 and data <= 61.661):
            self.sHutang.append("Sedang")
            self.nHutang.append(-(data - 61.661) / (61.661 - 45.566))
            self.sHutang.append("Tinggi")
            self.nHutang.append((data - 45.566) / (61.661 - 45.566))
        elif (data > 61.661):
            self.sHutang.append("Tinggi")
            self.nHutang.append(1.0)
            self.sHutang.append("Tinggi")
            self.nHutang.append(1.0)

    def inference(self):
        for iP in range(0, 2):
            # for iH in range(0, 2):

            if (self.sPendatapan[iP] == 'Rendah' and self.sHutang[iP] == 'Rendah'):
                sBerhak = 'Tidak'
            if (self.sPendatapan[iP] == 'Rendah' and self.sHutang[iP] == 'Sedang'):
                sBerhak = 'Tidak'
            if (self.sPendatapan[iP] == 'Rendah' and self.sHutang[iP] == 'Tinggi'):
                sBerhak = 'Ya'

            if (self.sPendatapan[iP] == 'Sedang' and self.sHutang[iP] == 'Rendah'):
                sBerhak = 'Tidak'
            if (self.sPendatapan[iP] == 'Sedang' and self.sHutang[iP] == 'Sedang'):
                sBerhak = 'Tidak'
            if (self.sPendatapan[iP] == 'Sedang' and self.sHutang[iP] == 'Tinggi'):
                sBerhak = 'Ya'

            if (self.sPendatapan[iP] == 'Tinggi' and self.sHutang[iP] == 'Rendah'):
                sBerhak = 'Tidak'
            if (self.sPendatapan[iP] == 'Tinggi' and self.sHutang[iP] == 'Sedang'):
                sBerhak = 'Tidak'
            if (self.sPendatapan[iP] == 'Tinggi' and self.sHutang[iP] == 'Tinggi'):
                sBerhak = 'Tidak'

            nBerhak = min(self.nPendapatan[iP], self.nHutang[iP])
            if (sBerhak == 'Tidak'):
                self.hasilTidak.append([nBerhak, sBerhak])
            else:
                self.hasilYa.append([nBerhak, sBerhak])

        if (len(self.hasilYa) == 0):
            self.hasilYa.append([0.0, "Ya"])
        if (len(self.hasilTidak) == 0):
            self.hasilTidak.append([0.0, "Tidak"])



    def deffuzification(self):
        tidak = self.hasilTidak[0][0]
        ya = self.hasilYa[0][0]
        if(ya+tidak > 0):
            outdefuzz = ((tidak * 50 + ya * 100) / (ya + tidak))
        else:
            outdefuzz = 0
        return outdefuzz

    def cekBerhak(self):
        if (self.deffuzification() > 81):
            return 'Ya'
        else:
            return 'Tidak'

    def main(self,pendapatan,hutang):
        self.cekPendapatan(pendapatan)
        self.cekHutang(hutang)
        self.inference()
        self.deffuzification()
        return self.cekBerhak(),self.deffuzification(),self.sPendatapan

kecsv = []
for inkremen in range(0,100):
    fuzzying = Fuzzy()
    hasilberhak = fuzzying.main(float(pendapatan[inkremen]),float(hutang[inkremen]))
    if(hasilberhak[0] == "Ya"):
        kecsv.append(str(inkremen+1))
        print((str(inkremen+1)+","+hasilberhak[0] +","+str(hasilberhak[1])+","+str(pendapatan[inkremen])))

csvfile = "tebakansafari.csv"
with open(csvfile, "w" , newline='') as output:
    writer = csv.writer(output)
    writer.writerow(["Index Data Terbaik"])
    writer.writerow(kecsv)


#menghitung huruf vokal
kalimat =str(input("Masukan kalimat : "))

vokal ="aiueoAIUEO"

jumlah_vokal = sum(1 for char in kalimat if char in vokal)

print(f"jumlah huruf vokal pada kalimat diatas : {jumlah_vokal}")

import requests
import time

api_key = "PZi73PCJs4WuiIzTAryqAtzGZroxLWxm"

phone_number = input("[-] Enter Phone Number [+] : ").strip()

if phone_number == "":
    print("[!] Aucun numéro fourni.")
    exit()

print("Collecting information...")
time.sleep(1)

url = "https://api.apilayer.com/number_verification/validate"
params = {
    "number": phone_number
}

headers = {
    "apikey": api_key
}

try:
    response = requests.get(url, headers=headers, params=params)
    response.raise_for_status()
except requests.RequestException as e:
    print(f"[!] Erreur HTTP : {e}")
    exit()

data = response.json()

# Vérification d’erreur API
if "error" in data:
    print("[!] Erreur API :", data["error"].get("message", "Erreur inconnue"))
    exit()

print("\n=== Phone Lookup Result ===")
print("Valid:        ", "Yes" if data.get("valid") else "No")
print("Number:       ", data.get("international_format", "N/A"))
print("Local Format: ", data.get("local_format", "N/A"))
print("Country Code: ", data.get("country_code", "N/A"))
print("Country:      ", data.get("country_name", "N/A"))
print("Location:     ", data.get("location", "N/A"))
print("Carrier:      ", data.get("carrier", "N/A"))
print("Line Type:    ", data.get("line_type", "N/A"))

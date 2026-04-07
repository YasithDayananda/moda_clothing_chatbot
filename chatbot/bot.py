import mysql.connector
import sys
sys.stdout.reconfigure(encoding='utf-8')
import json
import random
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.naive_bayes import MultinomialNB

# 🔹 Connect to Database
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="moda_db_sliit_y1_s2_wad"
)
cursor = db.cursor()

# 🔹 Load Intents
with open("intents.json", encoding="utf-8") as file:
    data = json.load(file)

patterns = []
tags = []

for intent in data["intents"]:
    for pattern in intent["patterns"]:
        patterns.append(pattern.lower())
        tags.append(intent["tag"])

# 🔹 Convert text to numbers
vectorizer = CountVectorizer()
X = vectorizer.fit_transform(patterns)

# 🔹 Train model
model = MultinomialNB()
model.fit(X, tags)

# 🔹 Check database for queries
def check_database(msg):
    msg = msg.lower()

    # 🔹 COLORS
    if "color" in msg or "colour" in msg:
        cursor.execute("SELECT DISTINCT product_color FROM products")
        results = cursor.fetchall()

        if results:
            clean_colors = set()
            for row in results:
                color = row[0].strip().lower()
                if color == "while":
                    color = "white"
                elif color == "lack":
                    color = "black"
                elif color == "ight green":
                    color = "light green"
                clean_colors.add(color.capitalize())
            return "Available colors: " + ", ".join(clean_colors)

    # 🔹 SIZES
    if "size" in msg:
        cursor.execute("SELECT DISTINCT product_size FROM products")
        results = cursor.fetchall()
        if results:
            sizes = [row[0] for row in results]
            return "Available sizes: " + ", ".join(sizes)

    # 🔹 PRICES
    if "price" in msg or "cost" in msg:
        cursor.execute("SELECT product_name, unit_price FROM products LIMIT 5")
        results = cursor.fetchall()
        if results:
            response = "Product Prices:<br>"
            for name, price in results:
                response += f"{name} - Rs.{price}<br>"
            return response

    # 🔹 SHOW PRODUCTS WITH IMAGES
    if "tshirt" in msg or "t-shirt" in msg or "shirt" in msg or "show products" in msg:
        cursor.execute("SELECT product_name, unit_price, image FROM products LIMIT 5")
        results = cursor.fetchall()
        if results:
            response = ""
            for name, price, image in results:
                response += f"""
                <div style='margin-bottom:15px; border-bottom:1px solid #ccc; padding-bottom:10px;'>
                    <img src='/sliit_first_year_web_development_project/uploads/{image}' width='120'><br>
                    <b>{name}</b><br>
                    Rs.{price}
                </div>
                """
            return response

    # 🔹 PRODUCT NAMES ONLY
    if "product" in msg or "items" in msg:
        cursor.execute("SELECT product_name FROM products LIMIT 5")
        results = cursor.fetchall()
        if results:
            names = [row[0] for row in results]
            return "Our products: " + ", ".join(names)

    # 🔹 ORDER DETAILS
    if "order" in msg:
        cursor.execute("SELECT product_name, quantity FROM orders LIMIT 3")
        results = cursor.fetchall()
        if results:
            response = "Recent Orders:<br>"
            for name, qty in results:
                response += f"{name} (Qty: {qty})<br>"
            return response

    return None

# 🔹 Get bot response
def get_response(msg):
    # FIRST → CHECK DATABASE
    db_response = check_database(msg)
    if db_response:
        return db_response

    # SECOND → USE INTENTS
    msg = msg.lower()
    msg_vec = vectorizer.transform([msg])
    probs = model.predict_proba(msg_vec)[0]
    max_prob = max(probs)
    tag = model.predict(msg_vec)[0]

    if max_prob < 0.1:
        return "Sorry, I didn't understand that. Please ask about products, delivery, or orders 😊"

    for intent in data["intents"]:
        if intent["tag"] == tag:
            return random.choice(intent["responses"])

    return "Something went wrong."

# 🔹 Get message from PHP
user_msg = sys.argv[1]
print(get_response(user_msg))
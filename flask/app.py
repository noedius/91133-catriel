from flask import Flask, render_template, request, jsonify, redirect, url_for
import sqlite3
import os
from contextlib import closing

app = Flask(__name__)

# Configuração do banco de dados
DATABASE = 'database.db'
DATABASE_PATH = os.path.join(os.path.dirname(__file__), DATABASE)

def get_db():
    db = sqlite3.connect(DATABASE_PATH)
    db.row_factory = sqlite3.Row
    return db

def criar_banco():
    if not os.path.exists(DATABASE_PATH):
        with closing(get_db()) as db:
            with app.open_resource('schema.sql', mode='r') as f:
                db.cursor().executescript(f.read())
            db.commit()

# Criar arquivo schema.sql para melhor organização
with open('schema.sql', 'w') as f:
    f.write('''
        CREATE TABLE IF NOT EXISTS produtos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            descricao TEXT,
            preco REAL NOT NULL,
            quantidade INTEGER NOT NULL
        );
    ''')

@app.route('/')
def index():
    return redirect(url_for('listar_produtos'))

@app.route('/cadastro')
def cadastro():
    return render_template('cadastro.html')

@app.route('/listagem')
def listar_produtos():
    return render_template('listagem.html')

@app.route('/api/produtos', methods=['GET', 'POST'])
def produtos():
    if request.method == 'POST':
        dados = request.get_json()
        try:
            with closing(get_db()) as db:
                cursor = db.cursor()
                cursor.execute('''
                    INSERT INTO produtos (nome, descricao, preco, quantidade)
                    VALUES (?, ?, ?, ?)
                ''', (dados['nome'], dados['descricao'], dados['preco'], dados['quantidade']))
                db.commit()
                produto_id = cursor.lastrowid
            return jsonify({
                'id': produto_id,
                'mensagem': 'Produto cadastrado com sucesso!'
            }), 201
        except sqlite3.Error as e:
            return jsonify({
                'erro': 'Erro ao inserir no banco de dados',
                'detalhes': str(e)
            }), 500
    
    # Método GET - Listar produtos
    try:
        with closing(get_db()) as db:
            cursor = db.cursor()
            cursor.execute('''
                SELECT id, nome, descricao, preco, quantidade 
                FROM produtos
                ORDER BY nome
            ''')
            produtos = cursor.fetchall()
        
        return jsonify([dict(produto) for produto in produtos])
    except sqlite3.Error as e:
        return jsonify({
            'erro': 'Erro ao consultar o banco de dados',
            'detalhes': str(e)
        }), 500

if __name__ == '__main__':
    criar_banco()
    app.run(debug=True)
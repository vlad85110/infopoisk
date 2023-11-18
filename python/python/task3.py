import sys


def read_text(file_name: str):
    lines = []

    with open(file_name, "r") as f:
        for line in f:
            lines.append(line)

    return lines


def write_text(file_name: str, lines: list):
    with open(file_name, "w") as f:
        for line in lines:
            f.write(line)


def parse_command_line():
    if len(sys.argv) < 4:
        print("python task3.py <file_name> <encoding mode> <offset>")
        exit(0)

    file_name = sys.argv[1] 
    mode = sys.argv[2]

    if mode not in ["e", "d"]:
        print("error: mode should be e (encrypt) or d (decipher)")
        exit(0) 

    try:
        offset = int(sys.argv[3]) 

        if offset <= 0:
            print("offset should be positive")
            exit(0)

    except ValueError:    
        print(f'offset error: {offset} is not integer')
        exit(0)


    return file_name, mode, offset 


def offset_sym(sym, offset):
    russian_letters = "абвгдежзийклмнопрстуфхцчшщъыьэюя"
    english_letters = "abcdefghijklmnopqrstuvwxyz"

    if sym in russian_letters:
        alphabet = russian_letters
    else:
        alphabet = english_letters

    sym_number = ord(sym) - ord(alphabet[0])
    new_sym_number = (sym_number + offset) % len(alphabet)
    new_sym = chr(new_sym_number + ord(alphabet[0]))
    return new_sym


def caesar(lines, mode, offset):
    if mode == "d":
        offset = -offset

    new_lines = []    
    for line in lines:
        new_line = "" 

        for sym in line:
            if sym.isalpha():
                new_sym = offset_sym(sym.lower(), offset)

                if sym.isupper():
                    new_sym = new_sym.upper()

                new_line += new_sym
            else:
                new_line += sym

        new_lines.append(new_line)

    return new_lines                

                               
f_name, mode, offset = parse_command_line()
lines = read_text(f_name)
new_lines = caesar(lines, mode, offset)
write_text("ceasar_output.txt", new_lines)

# s = offset_sym("а".lower(), 1)
# s = offset_sym("ю".lower(), 2)
# print(s)


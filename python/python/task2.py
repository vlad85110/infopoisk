def get_input(file_name: str):
    lines = []

    with open(file_name, "r") as f:
        for line in f:
            line = line.strip()

            for sym in line:
                if sym not in ['(', ')']:
                    print(f'error: symbol \'{sym}\' is not bracket')
                    exit(0)

            lines.append(line)

    return lines
    

def pop_until_open(stack: list):
    while True:
        el = stack.pop()
        if el == '(':
            return stack


def is_right(brackets: str):
    stack = []

    for bracket in brackets:
        if bracket == '(':
            stack.append(bracket)
        elif bracket == ')':
            try:
                stack = pop_until_open(stack)
            except IndexError:
                return False

    return len(stack) == 0


lines = get_input("brackets.txt")

for line in lines:
    res = is_right(line)
    print (f'{line} - {res}')


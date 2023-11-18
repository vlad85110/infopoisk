def get_input():
    inp_str = input("your number: ")

    try:
        return int(inp_str)  
    except ValueError:    
        print("error: value is not integer")
        exit(0)


def print_list(lst: list):
    for el in lst:
        print(el, end=" ")
    print()    
 

def next_row(prev: list):
    next = [1 for i in range(len(prev) + 1)]

    for i in range(1, len(next) - 1):
        next[i] = prev[i - 1] + prev[i]

    return next


def pascal_triangle(rows_num: int):
    rows = []

    initial_row = [1]
    rows.append(initial_row) 

    next = initial_row
    for i in range(rows_num - 1):
        next = next_row(next)
        rows.append(next)

    return rows

number = get_input()
rows = pascal_triangle(number)
for row in rows:
    print_list(row)
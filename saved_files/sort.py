arr = [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]
iter = 0

arrLen = len(arr)
for i in range(arrLen):
    min = arr[i]
    minIndex = 0
    for j in range(i, arrLen):
        if(min > arr[j]):
            min = arr[j]
            minIndex = j

    if(arr[i] != min):
        current = arr[i]
        arr[i] = arr[minIndex]
        arr[minIndex] = current
        print(str(iter) + "\t:\t",  end='')
        print(arr)
        iter += 1

print(arr)


# def shellSort(array):
# 	increment = len(array) // 2
# 	while increment > 0:

# 		for startPosition in range(increment):
# 			gapInsertionSort(array, startPosition, increment)

# 		print("После инкрементации размера на", increment,"массив:", array)

# 		increment //= 2

# def gapInsertionSort(array, low, gap):
    
# 	for i in range(low + gap, len(array), gap):
# 		currentvalue = array[i]
# 		position = i

# 		while position >= gap and array[position - gap] > currentvalue:
# 			array[position] = array[position - gap]
# 			position = position - gap

# 		array[position] = currentvalue


# shellSort([34,5, 56, 5, 67, 56, 567, 567, 87, 34, 23, 34,65, 7667, 78, 34, 33, 67, 89])

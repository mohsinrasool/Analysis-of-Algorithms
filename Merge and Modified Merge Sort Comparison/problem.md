**Advanced Analysis of Algorithms
Fall 2016 
Assignment 1**

Although merge sort runs in O(n lg n) worst-case time and insertion sort runs in O(n2) worst-case time, the constant factors in insertion sort can make it faster in practice for small problem sizes on many machines. Thus, it makes sense to coarsen the leaves of the recursion by using insertion sort within merge sort when subproblems become sufficiently small. Implement a modification of merge sort in which n/k sublists of length k are sorted using insertion sort and then merged using the standard merging mechanism, where k is also an input parameter. Also compute the running time of the sorting algorithm. Your task is to compute the optimal value of k for which merge sort runs fastest. A value of k would be considered optimal if by increasing the value of k, the running time of modified merge sort becomes larger than the running time standard merge sort. 

You are required to conduct experiments and give your analysis in form of a report. For each experiment, generate the data set of n integers randomly and find the optimal value of k. Perform these experiments for n=1000, 10000, 50,000, 100,000 and 1000000. In each experiment compute the running time of standard as well as modified merge sort for different values of k. In order to make your analysis more precise, conduct each experiment five times and record the average running time. In your report give complete details of your experiment (specifications of machine, language and compiler), a table to list the details of running times against each parameter (n and k). Also come up with a theoretical argument to justify the optimal value of k. 
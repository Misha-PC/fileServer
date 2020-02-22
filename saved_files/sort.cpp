#include <iostream>
using namespace std;

void bauble(){
    int arr[] = {9, 8, 7, 6, 5, 4, 3, 2, 1, 0};

    int iter = 0;
    bool end = true;
    
    
    while(end){

        cout << iter++  << "\t:\t[ ";
        for(int i = 0; i < sizeof(arr)/sizeof(int); i++){
            cout << arr[i] << " ";
        }
        cout << "]\n";

        for(int i = 1; i < sizeof(arr)/sizeof(int); i++){
            end = false;
            if(arr[i-1] > arr[i]){
                int x = arr[i-1];
                arr[i-1] = arr[i];
                arr[i] = x;
                end = true;
                break;
            }
        }
    

    }


    cout << "[ ";
    for(int i = 0; i < sizeof(arr)/sizeof(int); i++){
        cout << arr[i] << " ";
    }
    cout << "]\n";


}


void sort2(){
    int arr[] = {9, 8, 7, 6, 5, 4, 3, 2, 1, 0};
    int iter = 0;
    int end = false;

    while(!end){
        for(int i = 0; i <  sizeof(arr)/sizeof(int); i++){
            int min;
            for(int i = iter+1; i <  sizeof(arr)/sizeof(int); i++){
                min = arr[i-1];
                if(arr[i] < min){
                    min = arr[i];
                }
            }

        }
    }


    cout << "[ ";
    for(int i = 0; i < sizeof(arr)/sizeof(int); i++){
        cout << arr[i] << " ";
    }
    cout << "]\n";

}


int main(){
    bauble();
    // sort2();
}   

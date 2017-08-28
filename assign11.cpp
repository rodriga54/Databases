//  Abe Rodriguez
//  Z1758468
//  Date: 11/30/2015 

#include <mysql/mysql.h> 
#include <stdlib.h>
#include <stdio.h>
#include <iostream>
#include <iomanip>
#include <string>
using namespace std;

MYSQL *conn, mysql;     /* pointer to a connection */ 
MYSQL_RES *res;         /* pointer to a result */
MYSQL_ROW row;          /* pointer to a row */
int query_state;
int query_state2;

int main()
{

const char *server = "courses";           /* leave as localhost */ 
const char *user = "z1758468";            /* your znumber */ 
const char *password = "XXXXXXXXXXXX";    /* your password */ 
const char *database = "z1758468";        /* your znumber */
//conn = mysql_init(NULL);

/* Connect to database */ 
mysql_init(&mysql);
conn = mysql_real_connect(&mysql, server, user, password, database, 0,0,0);

//res = mysql_use_result(conn);

/* Check for error */ 
if (conn == NULL)
{
cout << mysql_error(&mysql) << endl; 
return 0;
}
else
{
cout << "Connection was Successful!\n" << endl;
}

/* send SQL query */
//query_state = mysql_query(conn, "SELECT * FROM flight");
query_state = mysql_query(conn, "SELECT * FROM flight LEFT JOIN manifest on flight.flightnum=manifest.flightnum LEFT JOIN passenger ON manifest.passnum=passenger.passnum");


if (query_state != 0)
{
cout << mysql_error(conn) << endl;
return 1; 
}

res = mysql_use_result(conn);


query_state = mysql_query(conn, "SELECT * FROM flight LEFT JOIN manifest on flight.flightnum=manifest.flightnum LEFT JOIN passenger ON manifest.passnum=passenger.passnum");
//res = mysql_use_result(conn);
//row = mysql_fetch_row(res);
int row2 = 0;

/* output table name */
cout << ("\nAll passengers on all flights\n");
cout<< left << setw(10)<< "Flight #" << setw(15) << "Origination"<< setw(15) << "Destination" << setw(15) << "Miles \t" <<endl;
while ((row = mysql_fetch_row(res)) != NULL)
{


    if (*row[0] != row2)
    {
    cout<< left << setw(10)<< row[0] << setw(15) << row[1]<< setw(15) << row[2] << setw(15) << row[3]<<endl;
    cout<< setw(15) << "     Passengers:" << setw(15) << "\tSeat #" << endl;
    }
    
        if(row[11] != NULL)
        {
        cout<<"     "<< row[11] <<" "<< setw(10) <<row[12]<< "\t"<< row[9] <<endl;
        row2 = *row[0];
        }
        else
        {
        cout<< left<< setw(10)<< row[0] << setw(15) << row[1]<< setw(15) << row[2] << setw(15) << row[3]<<endl;
        cout<< setw(15) << "     Passengers:" << setw(15) << "\tSeat #:" << endl;
        cout<< setw(15) << "     Empty" << setw(15) << "\t\tEmpty" << endl;
        row2 = *row[0];
        cout<<"\n"<<endl;
        }
}

/* close connection */ 
mysql_free_result(res); 
mysql_close(conn);
return 0;
}













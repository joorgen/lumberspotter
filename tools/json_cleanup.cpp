/*
Cleans up JSON files when you have this exact pattern

{
    "count":12,34,
    "name":asd
}

This will be turned in 
{
	"count":12.34,
	"name":asd
}

*/

#include <string>
#include <iostream>
#include <fstream>

using namespace std;

void replaceFirstCommaInLine(string& line)
{
	size_t found = line.find_first_of(",");
	size_t foundlast = line.find_last_of(",");
	if( found != foundlast )
	{
		line[found]	= '.';
	}
}

int main (int argc, char *argv[])
{
	if(argc != 2)
	{
		cout << endl;
		cout << "usage: json_cleanup input_file" << endl;
		cout << "result: mod_*input-file*";
		cout << endl;
		return 0;
	}
	string inputJSONFile = argv[1];
	
	ifstream in(inputJSONFile.c_str());
	ofstream out( (string("mod_") + inputJSONFile).c_str() );
	string line;
	while(getline(in,line))
	{
		replaceFirstCommaInLine(line);
		out << line << endl;
	}
	in.close();
	out.close();
	
	return 0;	
}

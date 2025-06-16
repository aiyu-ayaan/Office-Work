using System;
using System.Collections;





public class BMW
{
    private string name;
    private string milage;


    public BMW(string name, string milage)
    {
        this.name = name;
        this.milage = milage;
    }

    public string Name
    {
        get
        {
            return this.name;
        }
    }

    public string Milage
    {
        get
        {
            return this.name;
        }
        set
        {
            this.milage = value;
        }
    }

    public void PrintName()
    {
        Console.WriteLine($"{this.name} {this.milage}");
    }
}



class HelloWorld
{
    public static void Main(string[] args)
    {
        BMW bMW = new BMW("BMW M5 CS", "40");
        bMW.Milage = "400";
        bMW.PrintName();
        ArrayList list = new ArrayList<Int>();
        list.add(12);
        // foreach(var items in )
    }
}
using System;


public interface ICar
{
    public string Name();

    public string Milage();
}


public class BMW : ICar
{
    private string name;
    private string milage;


    public BMW(string name, string milage)
    {
        this.name = name;
        this.milage = milage;
    }

    public string Name()
    {
        return $"{this.name}";
    }

    public string Milage()
    {
        return $"Milage of the car is {this.milage}";
    }

    public void PrintName()
    {
        Console.WriteLine($"{this.Name()} {this.Milage()}");
    }
}



class HelloWorld
{
    public static void Main(string[] args)
    {
        BMW bMW =new BMW("BMW","40");
        bMW.PrintName();
    }
}
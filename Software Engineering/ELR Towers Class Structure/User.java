import java.util.ArrayList;

public class User {
    String fname;
    String lname;
    String email;
    String role;
    
    public User(String fname, String lname, String email, String role){
        this.fname = fname;
        this.lname = lname;
        this.email = email;
        this.role = role;
    }
    

    public String getFname() {
        return fname;
    }

    public void setFname(String fname) {
        this.fname = fname;
    }

    public String getLname() {
        return lname;
    }

    public void setLname(String lname) {
        this.lname = lname;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }

}
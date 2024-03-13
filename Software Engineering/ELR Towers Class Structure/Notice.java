public class Notice {
    String content;
    String date;
    String time;
    String noticeType;
    String noticeLocation;
    Administrator author;

    public Notice(String content, String date, String time, String noticeType, String noticeLocation, Administrator author) {
        this.content = content;
        this.date = date;
        this.time = time;
        this.noticeType = noticeType;
        this.noticeLocation = noticeLocation;
        this.author = author;
    }
    
}

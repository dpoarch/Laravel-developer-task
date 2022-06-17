import { Component, OnInit } from '@angular/core';
import { NewsletterService } from '../services/newsletter.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {

  constructor(public newsletter: NewsletterService) { }
  newsLetterList: any;
  
  ngOnInit(): void {
    this.getData();
  }


  getData(){
    this.newsletter.list().subscribe(res => {
      console.log(res);
      this.newsLetterList = res;
    })
  }
}

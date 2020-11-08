import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss']
})
export class FooterComponent implements OnInit {

  footerName: string;
  footerNameExtra: string;
  currentDate: string;
  constructor() { }

  ngOnInit(): void {
    this.footerName = 'FOOTER'; // 'Rucamanque RC';
    this.footerNameExtra = ''; // '- JAHQ';
    const today = new Date();
    this.currentDate = '' + today.getFullYear();
  }

}

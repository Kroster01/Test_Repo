import { Component, OnInit, HostBinding } from '@angular/core';
import { GamesService } from "../../services/games.service";
import { Game } from 'src/app/models/Game';

@Component({
  selector: 'app-game-list',
  templateUrl: './game-list.component.html',
  styleUrls: ['./game-list.component.css']
})
export class GameListComponent implements OnInit {
  @HostBinding('class') classes = 'row';
  games: any = [];
  constructor(private gamesService: GamesService) { }

  ngOnInit(): void {
    this.getGames();
  }

  getGames() {
    this.gamesService.getGames().subscribe(
      res => {
        console.log(res);
        this.games = res;
      },
      err => {
        console.log(err);
      }
    );
  }

  deleteGame(id: string) {
    this.gamesService.deleteGame(id)
    .subscribe(
      res => {
        console.log(res);
        this.getGames();
      },
      err => {console.log(err);}
    );
    console.log(id);
  }

}

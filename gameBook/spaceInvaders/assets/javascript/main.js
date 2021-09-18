
require(['state/Load','state/Start','state/Play','state/End','lib/phaser-no-physics.min'],function(Load,Start,Play,End){

    var _game = new Phaser.Game(800, 600, Phaser.AUTO, 'game');

    
    
    Load.init(_game,'Start'); 
    _game.state.add('Load',Load.getLoadState()); 
    
   
    Start.init(_game,'Play');
    _game.state.add('Start',Start.getStartState());
    
   
    Play.init(_game,'End');
    _game.state.add('Play',Play.getPlayState());
    
    
    End.init(_game,'Play');
    _game.state.add('End',End.getEndState());
    
    
    _game.state.start('Load');
    
});

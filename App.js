'use strict';
function Square({ onClick, value }) {
  return (
    <button className="square" onClick={onClick}>
      {value}
    </button>
  );
}

function Board () {
  const [squares, setSquares] = React.useState(Array(9).fill(null))
  const [isX, setIsX] = React.useState(true);

  const handleClick = (i) => {
    if (calculateWinner(squares) || squares[i]) {
      return
    }
    
    squares[i] = isX ? 'X' : 'O'
    setSquares(squares)
    setIsX(!isX)
  }

  const winner = calculateWinner(squares)
  let status
  
  if (winner) {
    status = `Vencedor: ${winner}`;


    const api = axios.create({
    baseURL:'http://localhost'
    });

    const resposta = api.get(`api/set.php?ganhador=${winner}&h=${squares}`);


  } else {
    status = 'Proximo Jogador: ' + (isX ? 'X' : 'O');
  }
  
  const handleRestart = () => {
    setIsX(true)
    setSquares(Array(9).fill(null))
    window.location.reload(false);
  }

  const renderSquare = (i) => {
    return <Square value={squares[i]} onClick={() => handleClick(i)} />
  }
  
  return (
    <div className="board">
      <h1 className="font">TicTacToe | Bring</h1>
      <div className="board-row">
        {renderSquare(0)}
        {renderSquare(1)}
        {renderSquare(2)}
      </div>
      <div className="board-row">
        {renderSquare(3)}
        {renderSquare(4)}
        {renderSquare(5)}
      </div>
      <div className="board-row">
        {renderSquare(6)}
        {renderSquare(7)}
        {renderSquare(8)}
      </div>
      <div className="status">{status}</div>
      <button className="restart" onClick={handleRestart}>Reiniciar Jogo!</button>
    </div>
  )
}

ReactDOM.render(
  <Board />,
  document.getElementById('root')
);

function calculateWinner(squares) {
  const winningPatterns = [
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],
    [0, 4, 8],
    [2, 4, 6],
  ]
  
  for (let i = 0; i < winningPatterns.length; i++) {
    const [a, b, c] = winningPatterns[i];
    if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c]) {
      return squares[a];
    }
  }
  return null;
}

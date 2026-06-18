<?php
/**
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>暇人かよ</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background: #0c0734;
            color: #fff;
            font-family: "Hiragino Sans", "Yu Gothic", sans-serif;
        }
        .idae-screen {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2vmin;
        }
        .idae-text {
            width: 100%;
            text-align: center;
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: 0.08em;
            font-size: clamp(3rem, 18vw, 14rem);
            text-shadow: 0 0.04em 0.12em rgba(0, 0, 0, 0.45);
            word-break: keep-all;
        }
        .idae-back {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.95rem;
            text-decoration: underline;
        }
        .idae-back:hover { color: #fff; }
    </style>
</head>
<body>
    <div class="idae-screen" aria-live="polite">
        <p class="idae-text">暇人かよ</p>
    </div>
    <?= $this->Html->link('ログインに戻る', '/', ['class' => 'idae-back']) ?>
</body>
</html>

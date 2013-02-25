<?php

/*
 * This file is part of the CursedScript package.
 *
 * (c) Soufian Salim <soufi@nsal.im>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CursedScript\GUI;

/**
 * Graphical constants
 *
 * @author Soufian Salim <soufi@nsal.im>
 */
interface GUI
{
	/**
	 * Positional constants
	 */
	
	const TOP    = 'top';
	const BOTTOM = 'bottom';
	const LEFT   = 'left';
	const RIGHT  = 'right';

	/**
	 * Line drawing constants
	 */

	const ULCORNER = ACS_ULCORNER;
	const LLCORNER = ACS_LLCORNER;
	const URCORNER = ACS_URCORNER;
	const LRCORNER = ACS_LRCORNER;
	const RTEE     = ACS_RTEE;
	const LTEE     = ACS_LTEE;
	const BTEE     = ACS_BTEE;
	const TTEE     = ACS_TTEE;
	const HLINE    = ACS_HLINE;
	const VLINE    = ACS_VLINE;
	const PLUS     = ACS_PLUS;
	const S1       = ACS_S1;
	const S9       = ACS_S9;
	const DIAMOND  = ACS_DIAMOND;
	const CKBOARD  = ACS_CKBOARD;
	const DEGREE   = ACS_DEGREE;
	const PLMINUS  = ACS_PLMINUS;
	const BULLET   = ACS_BULLET;
	const LARROW   = ACS_LARROW;
	const RARROW   = ACS_RARROW;
	const DARROW   = ACS_DARROW;
	const UARROW   = ACS_UARROW;
	const BOARD    = ACS_BOARD;
	const LANTERN  = ACS_LANTERN;
	const BLOCK    = ACS_BLOCK;

	/**
	 * Character display constants
	 */
	
	const ALT       = NCURSES_A_ALTCHARSET;
	const BLINK     = NCURSES_A_BLINK;
	const BOLD      = NCURSES_A_BOLD;
	const DIM       = NCURSES_A_DIM;
	const INVISIBLE = NCURSES_A_INVIS;
	const PROTECT   = NCURSES_A_PROTECT;
	const REVERSE   = NCURSES_A_REVERSE;
	const STANDOUT  = NCURSES_A_STANDOUT;
	const UNDERLINE = NCURSES_A_UNDERLINE;

	/**
	 * Color constants
	 */
	
	const BLACK   = COLOR_BLACK;
	const BLUE    = COLOR_BLUE;
	const GREEN   = COLOR_GREEN;
	const CYAN    = COLOR_CYAN;
	const RED     = COLOR_RED;
	const MAGENTA = COLOR_MAGENTA;
	const YELLOW  = COLOR_YELLOW;
	const WHITE   = COLOR_WHITE;
}
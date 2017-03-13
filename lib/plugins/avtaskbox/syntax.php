<?php
/*
 * DokuWiki task box plugin
 * Copyright (C) 2013 Sherri Wheeler
 * Usage:
 *
 * <task>
 * TITLE: A test task
 * PRIORITY: High
 * ESTIMATE: 4h
 * PROGRESS: 10%
 * ASSIGNED: Sherri
 * DESCRIPTION: Some stuff for you. You can have newlines in this part. Description must be the last item.
 * </task>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
class syntax_plugin_avtaskbox extends DokuWiki_Syntax_Plugin
{
 
	/**
	 * return some info
	 */
	function getInfo()
	{
		return array
		(
			'author' => 'Sherri Wheeler',
			'email'  => 'Use my website: http://syntaxseed.com',
			'date'   => '2013-02-25',
			'name'   => 'AV Task Box',
			'desc'   => 'Creates task/user story table boxes.',
			'url'	=> 'http://syntaxseed.com/project/avtaskbox/',
		);
	}
 
	/**
	 * What kind of syntax are we?
	 */
	function getType()
	{
		return 'substition';
	}
 
	/**
	 * Where to sort in?
	 */ 
	function getSort()
	{
		return 999;
	}
 
 
 /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
      $this->Lexer->addEntryPattern('\<task\>',$mode,'plugin_avtaskbox');
    }
 
    function postConnect() {
      $this->Lexer->addExitPattern('\</task\>','plugin_avtaskbox');
    }
 
 
    /**
     * Handle the match
     */
    function handle($match, $state, $pos, &$handler){
        switch ($state) {
          case DOKU_LEXER_ENTER : 
            return array($state, '');
          case DOKU_LEXER_MATCHED :
            break;
          case DOKU_LEXER_UNMATCHED :

			$resultStr = '<table class="inline" width="500">';
			
			preg_match('/^Title:(.*?)$/isxm', $match, $matches);
			$title = (!empty($matches[1]) && strlen(trim($matches[1]))>0) ? trim($matches[1]) : '&nbsp;';
			
			preg_match('/^Priority:(.*?)$/isxm', $match, $matches);
			$priority =(!empty($matches[1]) && strlen(trim($matches[1]))>0) ? 'Priority: '.trim($matches[1]) : '&nbsp;';
			
			preg_match('/^Estimate:(.*?)$/isxm', $match, $matches);
			$estimate = (!empty($matches[1]) && strlen(trim($matches[1]))>0) ? ' of '.trim($matches[1]) : '&nbsp;';
			
			preg_match('/^Assigned:(.*?)$/isxm', $match, $matches);
			$assigned = (!empty($matches[1]) && strlen(trim($matches[1]))>0) ? '('.trim($matches[1]).')' : '&nbsp;';
			
			preg_match('/^Progress:(.*?)$/isxm', $match, $matches);
			$progress = (!empty($matches[1]) && strlen(trim($matches[1]))>0) ? intval(preg_replace('[^0-9]','',$matches[1])) : '0';
		
			preg_match('/Description:(.*)/isx', $match, $matches);
			$description = (!empty($matches[1]) && strlen(trim($matches[1]))>0) ? trim($matches[1]) : '&nbsp;';

			if($progress<0){$progress=0;}
			if($progress>100){$progress=100;}
			$sizeLeft = 100-$progress;
            			
			$progbar .= '<span style="margin-top:3px;padding:0;height:8px;width: 100px;">'.($progress<=0 ? '' : '<span style="margin:0;padding:0;background-color:#74a6c9; height:8px; width:'.$progress.'"><img src="'.rtrim(dirname($_SERVER['PHP_SELF']),"/").'/lib/images/blank.gif" height="8" width="'.$progress.'" border="0" title="'.$progress.'%" alt="'.$progress.'%" hspace="0" vspace="0" style="height:8px;" /></span>') . ($progress>=100 ? '' : '<span style="margin:0;padding:0;background-color: #dee7ec;height:8px;width:'.$sizeLeft.'"><img src="'.rtrim(dirname($_SERVER['PHP_SELF']), "/").'/lib/images/blank.gif" height="8" width="'.$sizeLeft.'" border="0" title="'.$progress.'%" alt="'.$progress.'%" hspace="0" vspace="0" style="height:8px;" /></span>') .'</span>';
            
			$resultStr .= '<tr class="row0"><th><b>'.$title.'</b><span style="float:right;font-weight:normal;">'.$assigned.'</span></th></tr>';
			$resultStr .= '<tr><td>'.nl2br($description).'</td></tr>';
		    $resultStr .= '<tr><td><span style="float:right;font-size:0.9em;">('.$progress.'%'.$estimate.') '.$progbar.'</span>'.$priority.'</td></tr>';
		
			
			$resultStr .= '</table>';

            $match = $resultStr;
            return array($state, $match);


          case DOKU_LEXER_EXIT :
            return array($state, '');
          case DOKU_LEXER_SPECIAL :
            break;
        }
        return array();
    }
 

    /**
     * Create output
     */
    function render($mode, &$renderer, $data) {
      if($mode == 'xhtml'){
        list($state, $match) = $data;
          
        switch ($state) {
          case DOKU_LEXER_ENTER : 
            $renderer->doc .= "<span class='avtaskbox'>"; 
            break;

          case DOKU_LEXER_MATCHED :
            break;

          case DOKU_LEXER_UNMATCHED :

            $renderer->doc .= $match; break;          

          case DOKU_LEXER_EXIT :
            $renderer->doc .= "</span>"; 
            break;

          case DOKU_LEXER_SPECIAL :
            break;
        }
        return true; 
      }
	return false;
	}
}

?>
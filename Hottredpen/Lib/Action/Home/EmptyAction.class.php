<?php


class EmptyAction extends HomeAction{

        public function _empty(){
            $this->go404();
        }
}
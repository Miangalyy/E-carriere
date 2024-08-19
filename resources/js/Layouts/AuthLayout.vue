<template>
    <div>      
        <slot/>
    </div>
</template>
<style>
  .nav-bar{
      position: absolute;
      display: flex;
      width: 2100px;
      top: 0;
      left: 0;
      align-items: center;
      margin-left: 0px;
      justify-content: space-between;
  }
  #search{
    position: absolute;
    right: 300px;
  }
  
</style>
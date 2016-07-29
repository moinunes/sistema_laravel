

SELECT tbmenu.id_menu AS id_menu, tbmenu.titulo AS titulo, tbpermissao.id_permissao AS permite 
FROM tbmenu 
   LEFT JOIN tbpermissao ON ( tbpermissao.id_menu = tbmenu.id_menu ) AND tbpermissao.id_grupo = '6' 
WHERE id_pai = '1' 
ORDER BY tbmenu.id_menu 
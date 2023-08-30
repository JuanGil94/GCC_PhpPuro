/****** Script for SelectTopNRows command from SSMS  ******/
--SELECT SIGOBIUS,C.Ciudad,CONVERT(varchar, P.Fecha, 106) AS FechaEnLetras

SELECT P.ChequeoId,'SIGOBIUS' as sigobius,C.Ciudad,CONVERT(varchar, P.Fecha, 106) AS FechaEnLetras,
Sa.Sancionado,
	*
  FROM [GCC].[dbo].[Procesos] P
  INNER JOIN Seccionales S ON S.SeccionalId=P.SeccionalId
  INNER JOIN Ciudades C ON S.CiudadId=C.CiudadId
  INNER JOIN Sancionados Sa ON P.SancionadoId=Sa.SancionadoId
  INNER JOIN ChequeosSancionados CS ON CS.Sancionado=Sa.Sancionado
  where Numero='11001079000020230017100'


  select * from ChequeosSancionados where Sancionado='JAVIER ELIAS ARIAS IDARRAGA' and CiudadId=2153--and ChequeoId=229068
  order by ChequeoSancionadoId desc

  select * from Sancionados

  select * from Ciudades where Ciudad like '%dos%'
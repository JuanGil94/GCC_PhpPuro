CREATE FUNCTION dbo.MD5Hash
(
    @input VARCHAR(MAX)
)
RETURNS VARCHAR(32)
AS
BEGIN
    DECLARE @hash VARBINARY(16)
    SET @hash = HASHBYTES('MD5', @input)

    RETURN UPPER(CONVERT(VARCHAR(32), @hash, 2))
END
GO

-- Ejemplo de uso
DECLARE @texto VARCHAR(MAX) = '12345'
DECLARE @hash VARCHAR(32)

-- Calcular el hash MD5 del texto
SET @hash = dbo.MD5Hash(@texto)

-- Mostrar el hash
SELECT @hash AS MD5Hash
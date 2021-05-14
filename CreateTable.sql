-- SQL Server Code

CREATE TABLE [dbo].[tbl_TempRuuvi](
	[RuuviID] [int] IDENTITY(1000,1) NOT NULL,
	[ItemID] [nchar](20) NOT NULL,
	[Name] [nchar](50) NOT NULL,
	[SeqNo] [int] NULL,
	[Temperature] [decimal](18, 4) NULL,
	[Pressure] [decimal](18, 4) NULL,
	[Humidity] [decimal](18, 4) NULL,
	[Rssi] [int] NULL,
	[txPower] [decimal](18, 2) NULL,
	[Voltage] [decimal](18, 4) NULL,
	[MovCounter] [int] NULL,
	[accelX] [decimal](18, 4) NULL,
	[accelY] [decimal](18, 4) NULL,
	[accelZ] [decimal](18, 4) NULL,
	[TempTime] [datetime] NOT NULL,
	[deviceID] [nchar](50) NULL,
	[batteryLevel] [int] NULL,
	[lat] [decimal](18, 14) NULL,
	[lon] [decimal](18, 14) NULL,
 CONSTRAINT [PK_tbl_TempRuuvi] PRIMARY KEY CLUSTERED 
(
	[RuuviID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
